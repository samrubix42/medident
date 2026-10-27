<?php

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Database\Seeders\GalleryCategorySeeder;
use Database\Seeders\GalleryImageSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the gallery seeders replace general and physician with a general physician category', function () {
    GalleryCategory::factory()->create(['title' => 'General', 'slug' => 'general']);
    GalleryCategory::factory()->create(['title' => 'Physician', 'slug' => 'physician']);

    $this->seed([
        GalleryCategorySeeder::class,
        GalleryImageSeeder::class,
    ]);

    $this->seed([
        GalleryCategorySeeder::class,
        GalleryImageSeeder::class,
    ]);

    $generalPhysician = GalleryCategory::query()
        ->where('slug', 'general-physician')
        ->firstOrFail();

    expect(GalleryCategory::query()->count())->toBe(3)
        ->and($generalPhysician->title)->toBe('General Physician')
        ->and(GalleryImage::query()->where('category_id', $generalPhysician->id)->count())->toBe(8)
        ->and(GalleryImage::query()->count())->toBe(15);

    $this->assertDatabaseMissing('gallery_categories', ['slug' => 'general']);
    $this->assertDatabaseMissing('gallery_categories', ['slug' => 'physician']);
});
