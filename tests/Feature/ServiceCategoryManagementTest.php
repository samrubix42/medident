<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the service categories page', function () {
    $this->get('/admin/service-categories')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the service categories page', function () {
    $category = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    $this->actingAs(User::factory()->create())
        ->get('/admin/service-categories')
        ->assertOk()
        ->assertSee('Service categories')
        ->assertSee($category->title)
        ->assertSee($category->slug);
});

test('the create modal opens, closes, and creates a service category', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::service-categories')
        ->call('openCreateModal')
        ->assertSet('showModal', true)
        ->assertSet('isActive', true)
        ->set('title', 'Dental')
        ->assertSet('slug', 'dental')
        ->call('closeModal')
        ->assertSet('showModal', false)
        ->assertSet('title', '')
        ->call('openCreateModal')
        ->set('title', 'Dental')
        ->call('save')
        ->assertSet('showModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseHas('service_categories', [
        'title' => 'Dental',
        'slug' => 'dental',
        'is_active' => true,
    ]);
});

test('the edit modal opens with category data and updates the category', function () {
    $this->actingAs(User::factory()->create());

    $category = ServiceCategory::factory()->create([
        'title' => 'Old Category',
        'slug' => 'old-category',
        'is_active' => true,
    ]);

    Livewire::test('admin::service-categories')
        ->call('openEditModal', $category->id)
        ->assertSet('showModal', true)
        ->assertSet('editingCategoryId', $category->id)
        ->assertSet('title', 'Old Category')
        ->assertSet('slug', 'old-category')
        ->set('title', 'New Category')
        ->set('slug', 'new-category')
        ->set('isActive', false)
        ->call('save')
        ->assertSet('showModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseHas('service_categories', [
        'id' => $category->id,
        'title' => 'New Category',
        'slug' => 'new-category',
        'is_active' => false,
    ]);
});

test('the delete modal opens, closes, and deletes a category while uncategorizing its services', function () {
    $this->actingAs(User::factory()->create());

    $category = ServiceCategory::factory()->create();
    $service = Service::factory()->for($category, 'category')->create();

    Livewire::test('admin::service-categories')
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

    $this->assertDatabaseMissing('service_categories', ['id' => $category->id]);
    $this->assertDatabaseHas('services', ['id' => $service->id, 'service_category_id' => null]);
});

test('service category slugs must be unique', function () {
    $this->actingAs(User::factory()->create());

    ServiceCategory::factory()->create(['slug' => 'existing-slug']);

    Livewire::test('admin::service-categories')
        ->call('openCreateModal')
        ->set('title', 'Existing Category')
        ->set('slug', 'existing-slug')
        ->call('save')
        ->assertHasErrors(['slug' => 'unique'])
        ->assertSet('showModal', true);

    expect(ServiceCategory::count())->toBe(1);
});

test('service categories can be searched by title and slug', function () {
    $this->actingAs(User::factory()->create());

    ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    ServiceCategory::factory()->create([
        'title' => 'Dental Care',
        'slug' => 'dental',
    ]);

    Livewire::test('admin::service-categories')
        ->set('search', 'Physician')
        ->assertSee('Physician')
        ->assertDontSee('Dental Care');
});
