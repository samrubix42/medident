<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['title' => 'Clinic Photos', 'slug' => 'clinic-photos'],
            ['title' => 'Treatments', 'slug' => 'treatments'],
            ['title' => 'Team', 'slug' => 'team'],
            ['title' => 'Events', 'slug' => 'events'],
            ['title' => 'General Physician Dental Camp', 'slug' => 'general-physician-dental-camp'],
        ];

        foreach ($categories as $category) {
            GalleryCategory::updateOrCreate(
                ['slug' => $category['slug']],
                [
                    'title' => $category['title'],
                    'is_active' => true,
                ],
            );
        }
    }
}
