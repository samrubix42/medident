<?php

namespace Database\Factories;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<BlogPost>
 */
class BlogPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(7);

        return [
            'title' => Str::title($title),
            'slug' => Str::slug($title),
            'category_id' => BlogCategory::factory(),
            'content' => '<p>'.implode('</p><p>', fake()->paragraphs(6)).'</p>',
            'meta_title' => Str::title($title),
            'meta_description' => fake()->sentence(20),
            'meta_keyword' => implode(', ', fake()->words(4)),
            'feature_image' => null,
            'is_active' => true,
        ];
    }

    public function inactive(): static
    {
        return $this->state(fn (): array => [
            'is_active' => false,
        ]);
    }
}
