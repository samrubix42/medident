<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $extensions = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];

        $categories = GalleryCategory::query()
            ->get()
            ->keyBy('slug');

        $imageLinks = [];

        $folders = collect(File::directories(public_path('gallery')))
            ->sort();

        foreach ($folders as $directory) {
            $folder = basename($directory);
            $category = $categories->get(Str::slug($folder));

            if (! $category) {
                continue;
            }

            $images = collect(File::files($directory))
                ->filter(fn ($file): bool => in_array(strtolower($file->getExtension()), $extensions, true))
                ->sortBy(fn ($file): string => $file->getFilename());

            foreach ($images as $image) {
                $imageLink = 'gallery/'.rawurlencode($folder).'/'.rawurlencode($image->getFilename());

                $imageLinks[] = $imageLink;

                GalleryImage::updateOrCreate(
                    ['image_link' => $imageLink],
                    [
                        'category_id' => $category->id,
                        'is_active' => true,
                    ],
                );
            }
        }

        GalleryImage::query()
            ->where('image_link', 'like', 'gallery/%')
            ->whereNotIn('image_link', $imageLinks)
            ->delete();
    }
}
