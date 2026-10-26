<?php

use App\Models\Review;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Livewire\Livewire;

uses(RefreshDatabase::class);

/**
 * @param  array<int, array<string, mixed>>  $rows
 */
function makeReviewsCsv(array $rows): string
{
    $headers = [
        'name',
        'google_id',
        'place_id',
        'location_link',
        'reviews_link',
        'reviews_per_score',
        'rating',
        'review_id',
        'review_pagination_id',
        'author_link',
        'author_title',
        'author_id',
        'author_image',
        'review_text',
        'review_img_urls',
        'review_img_url',
        'owner_answer',
        'owner_answer_timestamp',
        'owner_answer_timestamp_datetime_utc',
        'review_link',
        'review_rating',
        'review_timestamp',
        'review_datetime_utc',
        'review_likes',
        'reviews_id',
    ];

    $handle = fopen('php://temp', 'r+');

    fputcsv($handle, $headers);

    foreach ($rows as $row) {
        fputcsv($handle, array_map(fn (string $header): mixed => $row[$header] ?? null, $headers));
    }

    rewind($handle);

    $content = stream_get_contents($handle);

    fclose($handle);

    return (string) $content;
}

function reviewImportRow(array $overrides = []): array
{
    return array_merge([
        'name' => 'MediDENT Multicare Clinic',
        'google_id' => 'google-123',
        'place_id' => 'place-123',
        'location_link' => 'https://maps.google.com/place',
        'reviews_link' => 'https://maps.google.com/reviews',
        'reviews_per_score' => '{"1":0,"2":1,"3":2,"4":4,"5":10}',
        'rating' => '4.60',
        'review_id' => 'review-123',
        'review_pagination_id' => 'page-1',
        'author_link' => 'https://maps.google.com/author',
        'author_title' => 'Jane Doe',
        'author_id' => 'author-123',
        'author_image' => 'https://example.com/avatar.jpg',
        'review_text' => 'Friendly staff, clean clinic, and a very comfortable visit.',
        'review_img_urls' => '["https://example.com/photo-1.jpg","https://example.com/photo-2.jpg"]',
        'review_img_url' => 'https://example.com/photo-1.jpg',
        'owner_answer' => 'Thank you for your kind words!',
        'owner_answer_timestamp' => '1735689600000',
        'owner_answer_timestamp_datetime_utc' => '2025-01-01 00:00:00',
        'review_link' => 'https://maps.google.com/review/123',
        'review_rating' => '5',
        'review_timestamp' => '1720000000000',
        'review_datetime_utc' => '2024-07-03 09:46:40',
        'review_likes' => '4',
        'reviews_id' => 'external-123',
    ], $overrides);
}

test('guests are redirected from the reviews page', function () {
    $this->get('/admin/reviews')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the reviews page', function () {
    $user = User::factory()->create();
    $review = Review::factory()->create([
        'author_title' => 'Visible Author',
        'review_text' => 'Visible review text.',
    ]);

    $this->actingAs($user)
        ->get('/admin/reviews')
        ->assertOk()
        ->assertSee('Import reviews')
        ->assertSee('Review library')
        ->assertSee($review->author_title);
});

test('reviews can be imported from a csv file and re-imported without duplicates', function () {
    $this->actingAs(User::factory()->create());

    $file = UploadedFile::fake()->createWithContent(
        'reviews.csv',
        makeReviewsCsv([reviewImportRow()]),
    );

    Livewire::test('admin::reviews')
        ->set('file', $file)
        ->call('import')
        ->assertHasNoErrors()
        ->assertSet('lastImportCount', 1)
        ->assertSet('lastSkippedCount', 0)
        ->assertDispatched('toast-show');

    $review = Review::firstOrFail();

    expect($review->review_id)->toBe('review-123')
        ->and($review->author_title)->toBe('Jane Doe')
        ->and($review->review_rating)->toBe(5)
        ->and($review->review_img_urls)->toBe([
            'https://example.com/photo-1.jpg',
            'https://example.com/photo-2.jpg',
        ])
        ->and($review->reviews_per_score)->toBe([1 => 0, 2 => 1, 3 => 2, 4 => 4, 5 => 10])
        ->and($review->review_datetime_utc?->format('Y-m-d H:i:s'))->toBe('2024-07-03 09:46:40');

    $updatedFile = UploadedFile::fake()->createWithContent(
        'reviews.csv',
        makeReviewsCsv([reviewImportRow(['review_text' => 'Updated review text.'])]),
    );

    Livewire::test('admin::reviews')
        ->set('file', $updatedFile)
        ->call('import')
        ->assertHasNoErrors();

    expect(Review::count())->toBe(1)
        ->and(Review::firstOrFail()->review_text)->toBe('Updated review text.');
});

test('reviews can be imported from a json file', function () {
    $this->actingAs(User::factory()->create());

    $file = UploadedFile::fake()->createWithContent(
        'reviews.json',
        json_encode([[
            'review_id' => 'json-review-123',
            'author_title' => 'JSON Author',
            'review_text' => 'Imported from JSON.',
            'review_rating' => 4,
            'review_datetime_utc' => '2026-02-01T12:00:00+00:00',
            'review_likes' => 2,
        ]]),
    );

    Livewire::test('admin::reviews')
        ->set('file', $file)
        ->call('import')
        ->assertHasNoErrors()
        ->assertSet('lastImportCount', 1);

    $review = Review::where('review_id', 'json-review-123')->firstOrFail();

    expect($review->author_title)->toBe('JSON Author')
        ->and($review->review_text)->toBe('Imported from JSON.')
        ->and($review->review_rating)->toBe(4)
        ->and($review->review_likes)->toBe(2);
});

test('reviews can be imported from an xlsx file', function () {
    $this->actingAs(User::factory()->create());

    $file = UploadedFile::fake()->createWithContent(
        'reviews.xlsx',
        (string) file_get_contents(base_path('tests/Fixtures/reviews.xlsx')),
    );

    Livewire::test('admin::reviews')
        ->set('file', $file)
        ->call('import')
        ->assertHasNoErrors()
        ->assertSet('lastImportCount', 1)
        ->assertSet('lastSkippedCount', 0);

    $review = Review::where('review_id', 'xlsx-1')->firstOrFail();

    expect($review->author_title)->toBe('XLSX Author')
        ->and($review->review_text)->toBe('Imported from Excel.')
        ->and($review->review_rating)->toBe(4)
        ->and($review->review_datetime_utc?->format('Y-m-d H:i:s'))->toBe('2026-02-01 12:00:00');
});

test('the delete modal opens, closes, and deletes a review', function () {
    $this->actingAs(User::factory()->create());

    $review = Review::factory()->create();

    Livewire::test('admin::reviews')
        ->call('confirmDelete', $review->id)
        ->assertSet('showDeleteModal', true)
        ->assertSet('reviewIdBeingDeleted', $review->id)
        ->call('cancelDelete')
        ->assertSet('showDeleteModal', false)
        ->assertSet('reviewIdBeingDeleted', null)
        ->call('confirmDelete', $review->id)
        ->call('deleteReview')
        ->assertSet('showDeleteModal', false)
        ->assertSet('reviewIdBeingDeleted', null)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
});

test('reviews can be searched in the listing', function () {
    $this->actingAs(User::factory()->create());

    Review::factory()->create([
        'author_title' => 'Alice Walker',
        'review_text' => 'Wonderful dental experience.',
    ]);

    Review::factory()->create([
        'author_title' => 'Bob Stone',
        'review_text' => 'Helpful medical consultation.',
    ]);

    Livewire::test('admin::reviews')
        ->set('search', 'Alice')
        ->assertSee('Alice Walker')
        ->assertDontSee('Bob Stone');
});
