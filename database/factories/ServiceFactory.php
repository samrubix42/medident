<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Service>
 */
class ServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->unique()->sentence(4);

        return [
            'service_category_id' => ServiceCategory::factory(),
            'title' => Str::title($title),
            'slug' => Str::slug($title),
            'short_description' => fake()->sentence(18),
            'content' => '<h2>'.Str::title($title).'</h2><p>'.implode('</p><p>', fake()->paragraphs(4)).'</p>',
            'image_link' => null,
            'meta_title' => Str::title($title),
            'meta_description' => fake()->sentence(20),
            'meta_keyword' => implode(', ', fake()->words(4)),
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
