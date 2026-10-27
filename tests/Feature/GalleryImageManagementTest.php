<?php

use App\Models\GalleryCategory;
use App\Models\GalleryImage;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the gallery images page', function () {
    $this->get('/admin/gallery-images')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the gallery images page', function () {
    $image = GalleryImage::factory()->create([
        'image_link' => 'dental/root-canal.jpg',
    ]);

    $this->actingAs(User::factory()->create())
        ->get('/admin/gallery-images')
        ->assertOk()
        ->assertSee('Gallery images')
        ->assertSee($image->category->title)
        ->assertSee('dental/root-canal.jpg');
});

test('an admin can upload a gallery image', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create());

    $category = GalleryCategory::factory()->create();

    Livewire::test('admin::gallery-images')
        ->call('openCreateModal')
        ->assertSet('showModal', true)
        ->set('categoryId', (string) $category->id)
        ->set('image', UploadedFile::fake()->image('clinic.jpg'))
        ->set('isActive', false)
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('showModal', false)
        ->assertDispatched('toast-show');

    $image = GalleryImage::query()->sole();

    expect($image->category_id)->toBe($category->id)
        ->and($image->is_active)->toBeFalse()
        ->and($image->image_link)->toStartWith('storage/gallery/');

    Storage::disk('public')->assertExists(Str::after($image->image_link, 'storage/'));
});

test('uploading a gallery image requires a category and image', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::gallery-images')
        ->call('openCreateModal')
        ->call('save')
        ->assertHasErrors([
            'categoryId' => 'required',
            'image' => 'required',
        ])
        ->assertSet('showModal', true);
});

test('an admin can update a gallery image and replace its upload', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create());

    Storage::disk('public')->put('gallery/old-image.jpg', 'old-image');

    $category = GalleryCategory::factory()->create();
    $newCategory = GalleryCategory::factory()->create();

    $image = GalleryImage::factory()->create([
        'category_id' => $category->id,
        'image_link' => 'storage/gallery/old-image.jpg',
        'is_active' => true,
    ]);

    Livewire::test('admin::gallery-images')
        ->call('openEditModal', $image->id)
        ->assertSet('categoryId', (string) $category->id)
        ->assertSet('currentImageLink', 'storage/gallery/old-image.jpg')
        ->set('categoryId', (string) $newCategory->id)
        ->set('isActive', false)
        ->set('image', UploadedFile::fake()->image('new-image.jpg'))
        ->call('save')
        ->assertHasNoErrors()
        ->assertSet('showModal', false)
        ->assertDispatched('toast-show');

    $image->refresh();

    expect($image->category_id)->toBe($newCategory->id)
        ->and($image->is_active)->toBeFalse()
        ->and($image->image_link)->not->toBe('storage/gallery/old-image.jpg');

    Storage::disk('public')->assertMissing('gallery/old-image.jpg');
    Storage::disk('public')->assertExists(Str::after($image->image_link, 'storage/'));
});

test('an admin can delete a gallery image and its upload', function () {
    Storage::fake('public');

    $this->actingAs(User::factory()->create());

    Storage::disk('public')->put('gallery/delete-me.jpg', 'delete-me');

    $image = GalleryImage::factory()->create([
        'image_link' => 'storage/gallery/delete-me.jpg',
    ]);

    Livewire::test('admin::gallery-images')
        ->call('confirmDelete', $image->id)
        ->assertSet('showDeleteModal', true)
        ->call('deleteImage')
        ->assertSet('showDeleteModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('gallery_images', ['id' => $image->id]);
    Storage::disk('public')->assertMissing('gallery/delete-me.jpg');
});
