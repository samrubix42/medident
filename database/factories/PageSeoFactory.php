<?php

namespace Database\Factories;

use App\Models\PageSeo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<PageSeo>
 */
class PageSeoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = Str::title(fake()->unique()->words(2, true));

        return [
            'page_name' => $name,
            'page_slug' => Str::slug($name),
            'meta_title' => $name.' | MediDENT Multicare Clinic',
            'meta_description' => fake()->sentence(20),
            'meta_keywords' => implode(', ', fake()->words(4)),
        ];
    }
}
