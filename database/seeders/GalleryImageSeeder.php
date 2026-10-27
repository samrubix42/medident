<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Database\Seeder;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = GalleryCategory::query()
            ->whereIn('slug', ['general-physician', 'dental', 'camp'])
            ->get()
            ->keyBy('slug');

        $images = [
            ['category' => 'general-physician', 'link' => 'images/hero-img.jpg'],
            ['category' => 'general-physician', 'link' => 'images/general-diseases.jpg'],
            ['category' => 'general-physician', 'link' => 'images/vaccination.jpg'],
            ['category' => 'general-physician', 'link' => 'images/gastro.jpg'],
            ['category' => 'general-physician', 'link' => 'images/heart.jpg'],
            ['category' => 'general-physician', 'link' => 'images/respiratory.jpg'],
            ['category' => 'general-physician', 'link' => 'images/throid.jpg'],
            ['category' => 'general-physician', 'link' => 'doctors/Dr.-Divya-Prakash.jpeg'],
            ['category' => 'dental', 'link' => 'dental/cosmetic-dental.jpg'],
            ['category' => 'dental', 'link' => 'dental/KIDSDENTISTRY.jpg'],
            ['category' => 'dental', 'link' => 'dental/Dental-Implants.jpg'],
            ['category' => 'dental', 'link' => 'dental/painless-extraction.jpg'],
            ['category' => 'dental', 'link' => 'dental/dental-filling.jpg'],
            ['category' => 'dental', 'link' => 'dental/root-canal.jpg'],
            ['category' => 'dental', 'link' => 'doctors/Dr.-RatikaGupta.jpg'],
        ];

        foreach ($images as $image) {
            $category = $categories->get($image['category']);

            if (! $category) {
                continue;
            }

            GalleryImage::updateOrCreate(
                ['image_link' => $image['link']],
                [
                    'category_id' => $category->id,
                    'is_active' => true,
                ],
            );
        }
    }
}
