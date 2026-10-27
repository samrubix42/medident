<?php

use App\Models\Review;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;

uses(RefreshDatabase::class);

test('the review seeder creates the embedded outscraper reviews', function () {
    $this->seed(ReviewSeeder::class);

    $review = Review::query()->first();

    expect(Review::count())->toBe(61)
        ->and($review)->not->toBeNull()
        ->and($review->author_title)->not->toBeNull()
        ->and($review->review_rating)->toBeInt()
        ->and($review->review_datetime_utc)->not->toBeNull()
        ->and($review->reviews_per_score)->toBeArray();
});

test('the review seeder can be run more than once without creating duplicates', function () {
    $this->seed(ReviewSeeder::class);

    $count = Review::count();

    $this->seed(ReviewSeeder::class);

    expect(Review::count())->toBe($count);
});

test('the review seeder avoids unsupported sqlite upsert syntax', function () {
    DB::connection()->enableQueryLog();

    $this->seed(ReviewSeeder::class);

    $queries = collect(DB::getQueryLog())->pluck('query');

    DB::connection()->disableQueryLog();
    DB::connection()->flushQueryLog();

    expect($queries->contains(
        fn (string $query): bool => str_contains(strtolower($query), 'on conflict'),
    ))->toBeFalse();
});
