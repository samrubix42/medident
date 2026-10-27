<?php

namespace Database\Seeders;

use App\Models\GalleryCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class GalleryCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $folders = collect(File::directories(public_path('gallery')))
            ->map(fn (string $directory): string => basename($directory))
            ->sort()
            ->values();

        $slugs = $folders
            ->map(fn (string $folder): string => Str::slug($folder))
            ->all();

        GalleryCategory::query()
            ->whereNotIn('slug', $slugs)
            ->delete();

        foreach ($folders as $folder) {
            GalleryCategory::updateOrCreate(
                ['slug' => Str::slug($folder)],
                [
                    'title' => Str::headline($folder),
                    'is_active' => true,
                ],
            );
        }
    }
}
