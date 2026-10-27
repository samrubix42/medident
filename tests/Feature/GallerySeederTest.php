<?php

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Database\Seeders\GalleryCategorySeeder;
use Database\Seeders\GalleryImageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

uses(RefreshDatabase::class);

test('the gallery seeders build categories and images from the gallery folders', function () {
    $galleryPath = public_path('gallery');
    $extensions = ['jpg', 'jpeg', 'png', 'webp', 'avif', 'gif'];

    $folders = collect(File::directories($galleryPath))
        ->sort()
        ->values();

    $imageFiles = fn (string $directory) => collect(File::files($directory))
        ->filter(fn ($file): bool => in_array(strtolower($file->getExtension()), $extensions, true));

    $expectedImageCount = $folders->sum(fn (string $directory): int => $imageFiles($directory)->count());

    $general = GalleryCategory::factory()->create(['title' => 'General', 'slug' => 'general']);
    $physician = GalleryCategory::factory()->create(['title' => 'Physician', 'slug' => 'physician']);

    GalleryImage::factory()->create([
        'category_id' => $general->id,
        'image_link' => 'images/hero-img.jpg',
    ]);

    GalleryImage::factory()->create([
        'category_id' => $physician->id,
        'image_link' => 'images/heart.jpg',
    ]);

    $this->seed([
        GalleryCategorySeeder::class,
        GalleryImageSeeder::class,
    ]);

    $this->seed([
        GalleryCategorySeeder::class,
        GalleryImageSeeder::class,
    ]);

    $generalPhysicianFolder = $folders
        ->first(fn (string $directory): bool => Str::slug(basename($directory)) === 'general-physician');

    $generalPhysician = GalleryCategory::query()
        ->where('slug', 'general-physician')
        ->firstOrFail();

    $firstImage = $imageFiles($generalPhysicianFolder)
        ->sortBy(fn ($file): string => $file->getFilename())
        ->first();

    $firstImageLink = 'gallery/'.rawurlencode(basename($generalPhysicianFolder)).'/'.rawurlencode($firstImage->getFilename());

    expect(GalleryCategory::query()->count())->toBe($folders->count())
        ->and($generalPhysician->title)->toBe('General Physician')
        ->and(GalleryImage::query()->where('category_id', $generalPhysician->id)->count())->toBe($imageFiles($generalPhysicianFolder)->count())
        ->and(GalleryImage::query()->count())->toBe($expectedImageCount);

    $this->assertDatabaseHas('gallery_images', [
        'category_id' => $generalPhysician->id,
        'image_link' => $firstImageLink,
        'is_active' => true,
    ]);

    $this->assertDatabaseMissing('gallery_categories', ['slug' => 'general']);
    $this->assertDatabaseMissing('gallery_categories', ['slug' => 'physician']);
    $this->assertDatabaseMissing('gallery_images', ['image_link' => 'images/hero-img.jpg']);
    $this->assertDatabaseMissing('gallery_images', ['image_link' => 'images/heart.jpg']);
});
