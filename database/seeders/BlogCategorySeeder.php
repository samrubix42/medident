<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use Illuminate\Database\Seeder;

class BlogCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'General Health', 'slug' => 'general-health'],
            ['title' => 'Dental Care', 'slug' => 'dental-care'],
            ['title' => 'Heart Health', 'slug' => 'heart-health'],
            ['title' => 'Diabetes Care', 'slug' => 'diabetes-care'],
            ['title' => 'Respiratory Care', 'slug' => 'respiratory-care'],
        ];

        foreach ($categories as $category) {
            BlogCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'title' => $category['title'],
                    'is_active' => true,
                ],
            );
        }
    }
}
