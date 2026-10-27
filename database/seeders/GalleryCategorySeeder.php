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
            ['title' => 'General', 'slug' => 'general'],
            ['title' => 'Physician', 'slug' => 'physician'],
            ['title' => 'Dental', 'slug' => 'dental'],
            ['title' => 'Camp', 'slug' => 'camp'],
        ];

        GalleryCategory::query()
            ->whereNotIn('slug', array_column($categories, 'slug'))
            ->delete();

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
