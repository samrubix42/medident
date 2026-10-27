<?php

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the gallery page is available and shows active category photos', function () {
    $dental = GalleryCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
        'is_active' => true,
    ]);

    $physician = GalleryCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
        'is_active' => true,
    ]);

    GalleryImage::factory()->create([
        'category_id' => $dental->id,
        'image_link' => 'dental/root-canal.jpg',
    ]);

    GalleryImage::factory()->create([
        'category_id' => $physician->id,
        'image_link' => 'images/heart.jpg',
    ]);

    expect(route('gallery'))->toBe(url('/gallery'));

    $this->get(route('gallery'))
        ->assertOk()
        ->assertSee('Gallery')
        ->assertSee('Browse the gallery.')
        ->assertSee('Dental')
        ->assertSee('Physician')
        ->assertSee('dental/root-canal.jpg', false)
        ->assertSee('images/heart.jpg', false);
});

test('the gallery hides inactive images and photos from inactive categories', function () {
    $dental = GalleryCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
        'is_active' => true,
    ]);

    $physician = GalleryCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
        'is_active' => false,
    ]);

    $general = GalleryCategory::factory()->create([
        'title' => 'General',
        'slug' => 'general',
        'is_active' => true,
    ]);

    GalleryImage::factory()->create([
        'category_id' => $dental->id,
        'image_link' => 'dental/root-canal.jpg',
    ]);

    GalleryImage::factory()->create([
        'category_id' => $physician->id,
        'image_link' => 'images/heart.jpg',
    ]);

    GalleryImage::factory()->inactive()->create([
        'category_id' => $general->id,
        'image_link' => 'images/vaccination.jpg',
    ]);

    $this->get(route('gallery'))
        ->assertOk()
        ->assertSee('dental/root-canal.jpg', false)
        ->assertDontSee('images/heart.jpg', false)
        ->assertDontSee('images/vaccination.jpg', false);
});

test('a visitor can filter gallery photos by category', function () {
    $dental = GalleryCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
        'is_active' => true,
    ]);

    $physician = GalleryCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
        'is_active' => true,
    ]);

    GalleryImage::factory()->create([
        'category_id' => $dental->id,
        'image_link' => 'dental/root-canal.jpg',
    ]);

    GalleryImage::factory()->create([
        'category_id' => $physician->id,
        'image_link' => 'images/heart.jpg',
    ]);

    Livewire::test('pages::gallery')
        ->assertSee('dental/root-canal.jpg', false)
        ->assertSee('images/heart.jpg', false)
        ->call('selectCategory', 'dental')
        ->assertSet('category', 'dental')
        ->assertSee('dental/root-canal.jpg', false)
        ->assertDontSee('images/heart.jpg', false)
        ->call('selectCategory', 'all')
        ->assertSet('category', 'all')
        ->assertSee('images/heart.jpg', false);
});

test('an empty gallery category shows an empty state', function () {
    GalleryCategory::factory()->create([
        'title' => 'Camp',
        'slug' => 'camp',
        'is_active' => true,
    ]);

    Livewire::test('pages::gallery')
        ->call('selectCategory', 'camp')
        ->assertSee('No photos here yet.')
        ->assertSee('View all photos');
});
