<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the blog categories page', function () {
    $this->get('/admin/blog-categories')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the blog categories page', function () {
    $category = BlogCategory::factory()->create([
        'title' => 'Heart Health',
        'slug' => 'heart-health',
    ]);

    $this->actingAs(User::factory()->create())
        ->get('/admin/blog-categories')
        ->assertOk()
        ->assertSee('Blog categories')
        ->assertSee($category->title)
        ->assertSee($category->slug);
});

test('the create modal opens, closes, and creates a blog category', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-categories')
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

    $this->assertDatabaseHas('blog_categories', [
        'title' => 'Dental Care',
        'slug' => 'dental-care',
        'is_active' => true,
    ]);
});

test('the edit modal opens with category data and updates the category', function () {
    $this->actingAs(User::factory()->create());

    $category = BlogCategory::factory()->create([
        'title' => 'Old Title',
        'slug' => 'old-title',
        'is_active' => true,
    ]);

    Livewire::test('admin::blog-categories')
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

    $this->assertDatabaseHas('blog_categories', [
        'id' => $category->id,
        'title' => 'New Title',
        'slug' => 'new-title',
        'is_active' => false,
    ]);
});

test('the delete modal opens, closes, and deletes a category while uncategorizing its posts', function () {
    $this->actingAs(User::factory()->create());

    $category = BlogCategory::factory()->create();
    $post = BlogPost::factory()->for($category, 'category')->create();

    Livewire::test('admin::blog-categories')
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

    $this->assertDatabaseMissing('blog_categories', ['id' => $category->id]);
    $this->assertDatabaseHas('blog_posts', ['id' => $post->id, 'category_id' => null]);
});

test('blog category slugs must be unique', function () {
    $this->actingAs(User::factory()->create());

    BlogCategory::factory()->create(['slug' => 'existing-slug']);

    Livewire::test('admin::blog-categories')
        ->call('openCreateModal')
        ->set('title', 'Existing Category')
        ->set('slug', 'existing-slug')
        ->call('save')
        ->assertHasErrors(['slug' => 'unique'])
        ->assertSet('showModal', true);

    expect(BlogCategory::count())->toBe(1);
});

test('blog categories can be searched by title and slug', function () {
    $this->actingAs(User::factory()->create());

    BlogCategory::factory()->create([
        'title' => 'Clinic Topics',
        'slug' => 'clinic-topics',
    ]);

    BlogCategory::factory()->create([
        'title' => 'Awards',
        'slug' => 'awards',
    ]);

    Livewire::test('admin::blog-categories')
        ->set('search', 'Clinic')
        ->assertSee('Clinic Topics')
        ->assertDontSee('Awards');
});
