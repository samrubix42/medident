<?php

namespace Database\Factories;

use App\Models\Review;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $reviewDate = fake()->dateTimeBetween('-1 year');

        return [
            'name' => 'MediDENT Multicare Clinic',
            'google_id' => fake()->uuid(),
            'place_id' => fake()->uuid(),
            'location_link' => fake()->url(),
            'reviews_link' => fake()->url(),
            'reviews_per_score' => [
                '1' => fake()->numberBetween(0, 10),
                '2' => fake()->numberBetween(0, 10),
                '3' => fake()->numberBetween(0, 20),
                '4' => fake()->numberBetween(10, 50),
                '5' => fake()->numberBetween(20, 100),
            ],
            'rating' => fake()->randomFloat(2, 3, 5),
            'review_id' => fake()->unique()->uuid(),
            'review_pagination_id' => fake()->uuid(),
            'author_link' => fake()->url(),
            'author_title' => fake()->name(),
            'author_id' => fake()->uuid(),
            'author_image' => fake()->imageUrl(),
            'review_text' => fake()->paragraph(),
            'review_img_urls' => [],
            'review_img_url' => null,
            'owner_answer' => null,
            'owner_answer_timestamp' => null,
            'owner_answer_timestamp_datetime_utc' => null,
            'review_link' => fake()->url(),
            'review_rating' => fake()->numberBetween(1, 5),
            'review_timestamp' => $reviewDate->getTimestamp() * 1000,
            'review_datetime_utc' => $reviewDate,
            'review_likes' => fake()->numberBetween(0, 50),
            'reviews_id' => fake()->uuid(),
        ];
    }
}
