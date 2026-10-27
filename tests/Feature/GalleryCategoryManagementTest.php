<?php

use App\Models\GalleryCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the gallery categories page', function () {
    $this->get('/admin/gallery-categories')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the gallery categories page', function () {
    $user = User::factory()->create();
    $category = GalleryCategory::factory()->create([
        'title' => 'Clinic Photos',
        'slug' => 'clinic-photos',
    ]);

    $this->actingAs($user)
        ->get('/admin/gallery-categories')
        ->assertOk()
        ->assertSee('Gallery categories')
        ->assertSee($category->title)
        ->assertSee($category->slug);
});

test('the create modal opens, closes, and creates a category', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::gallery-categories')
        ->call('openCreateModal')
        ->assertSet('showModal', true)
        ->assertSet('isActive', true)
        ->set('title', 'Dental Care')
        ->assertSet('slug', 'dental-care')
        ->call('closeModal')
        ->assertSet('showModal', false)
        ->assertSet('title', '')
        ->call('openCreateModal')
        ->set('title', 'Dental Care')
        ->call('save')
        ->assertSet('showModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseHas('gallery_categories', [
        'title' => 'Dental Care',
        'slug' => 'dental-care',
        'is_active' => true,
    ]);
});

test('the edit modal opens with category data and updates the category', function () {
    $this->actingAs(User::factory()->create());

    $category = GalleryCategory::factory()->create([
        'title' => 'Old Title',
        'slug' => 'old-title',
        'is_active' => true,
    ]);

    Livewire::test('admin::gallery-categories')
        ->call('openEditModal', $category->id)
        ->assertSet('showModal', true)
        ->assertSet('editingCategoryId', $category->id)
        ->assertSet('title', 'Old Title')
        ->assertSet('slug', 'old-title')
        ->set('title', 'New Title')
        ->set('slug', 'new-title')
        ->set('isActive', false)
        ->call('save')
        ->assertSet('showModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseHas('gallery_categories', [
        'id' => $category->id,
        'title' => 'New Title',
        'slug' => 'new-title',
        'is_active' => false,
    ]);
});

test('the delete modal opens, closes, and deletes a category', function () {
    $this->actingAs(User::factory()->create());

    $category = GalleryCategory::factory()->create();

    Livewire::test('admin::gallery-categories')
        ->call('confirmDelete', $category->id)
        ->assertSet('showDeleteModal', true)
        ->assertSet('categoryIdBeingDeleted', $category->id)
        ->call('cancelDelete')
        ->assertSet('showDeleteModal', false)
        ->assertSet('categoryIdBeingDeleted', null)
        ->call('confirmDelete', $category->id)
        ->call('deleteCategory')
        ->assertSet('showDeleteModal', false)
        ->assertSet('categoryIdBeingDeleted', null)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('gallery_categories', ['id' => $category->id]);
});

test('gallery category slugs must be unique', function () {
    $this->actingAs(User::factory()->create());

    GalleryCategory::factory()->create(['slug' => 'existing-slug']);

    Livewire::test('admin::gallery-categories')
        ->call('openCreateModal')
        ->set('title', 'Existing Category')
        ->set('slug', 'existing-slug')
        ->call('save')
        ->assertHasErrors(['slug' => 'unique'])
        ->assertSet('showModal', true);

    expect(GalleryCategory::count())->toBe(1);
});

test('gallery categories can be searched by title and slug', function () {
    $this->actingAs(User::factory()->create());

    GalleryCategory::factory()->create([
        'title' => 'Clinic Photos',
        'slug' => 'clinic-photos',
    ]);

    GalleryCategory::factory()->create([
        'title' => 'Awards',
        'slug' => 'awards',
    ]);

    Livewire::test('admin::gallery-categories')
        ->set('search', 'Clinic')
        ->assertSee('Clinic Photos')
        ->assertDontSee('Awards');
});
