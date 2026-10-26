<?php

use App\Models\Review;
use Database\Seeders\ReviewSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the review seeder creates the embedded outscraper reviews', function () {
    $this->seed(ReviewSeeder::class);

    $review = Review::query()->first();

    expect(Review::count())->toBe(61)
        ->and($review)->not->toBeNull()
        ->and($review->author_title)->not->toBeNull()
        ->and($review->review_rating)->toBeInt()
        ->and($review->review_datetime_utc)->not->toBeNull();
});

test('the review seeder can be run more than once without creating duplicates', function () {
    $this->seed(ReviewSeeder::class);

    $count = Review::count();

    $this->seed(ReviewSeeder::class);

    expect(Review::count())->toBe($count);
});
