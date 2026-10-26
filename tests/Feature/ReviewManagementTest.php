<?php

use App\Models\Review;
use App\Models\User;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

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
        ->assertSee('Reset reviews')
        ->assertSee('Review library')
        ->assertSee($review->author_title);
});

test('reviews can be reset to the seeded data', function () {
    $this->actingAs(User::factory()->create());

    $this->seed(ReviewSeeder::class);

    $seededReview = Review::firstOrFail();
    $seededReviewId = $seededReview->review_id;

    $seededReview->delete();

    Review::factory()->create([
        'author_title' => 'Temporary Review',
        'review_text' => 'This review should be removed by the reset.',
    ]);

    Livewire::test('admin::reviews')
        ->call('resetReviews')
        ->assertDispatched('toast-show');

    expect(Review::count())->toBe(61)
        ->and(Review::where('review_id', $seededReviewId)->exists())->toBeTrue()
        ->and(Review::where('author_title', 'Temporary Review')->exists())->toBeFalse();
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
