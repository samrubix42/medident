<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the blog management pages', function () {
    $this->get('/admin/blog-posts')->assertRedirect('/login');
    $this->get('/admin/blog-posts/create')->assertRedirect('/login');

    $post = BlogPost::factory()->create();

    $this->get(route('admin.blog-posts.edit', $post))->assertRedirect('/login');
});

test('an authenticated admin can view the blog posts page and create form', function () {
    $category = BlogCategory::factory()->create([
        'title' => 'Heart Health',
        'slug' => 'heart-health',
    ]);

    $post = BlogPost::factory()->for($category, 'category')->create([
        'title' => 'Heart Health Basics',
        'slug' => 'heart-health-basics',
    ]);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/blog-posts')
        ->assertOk()
        ->assertSee('Blog posts')
        ->assertSee($post->title)
        ->assertSee($category->title);

    $this->actingAs($user)
        ->get('/admin/blog-posts/create')
        ->assertOk()
        ->assertSee('Create blog post')
        ->assertSee('tinymce/tinymce.min.js', false);
});

test('an admin can create an active blog post with SEO details and a feature image', function () {
    Storage::fake('public');

    $category = BlogCategory::factory()->create();

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-posts-form')
        ->assertSet('blogPostId', null)
        ->set('title', 'Heart Health Basics')
        ->assertSet('slug', 'heart-health-basics')
        ->set('categoryId', $category->id)
        ->set('content', '<h2>Start small</h2><p>Consistency matters more than perfection.</p>')
        ->set('metaTitle', 'Heart Health Basics Guide')
        ->set('metaDescription', 'A practical guide to everyday heart health.')
        ->set('metaKeyword', 'heart health, healthy habits')
        ->set('featureImage', UploadedFile::fake()->image('cover.jpg'))
        ->set('isActive', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.blog-posts'));

    $post = BlogPost::query()->sole();

    expect($post->title)->toBe('Heart Health Basics')
        ->and($post->slug)->toBe('heart-health-basics')
        ->and($post->category_id)->toBe($category->id)
        ->and($post->meta_title)->toBe('Heart Health Basics Guide')
        ->and($post->meta_description)->toBe('A practical guide to everyday heart health.')
        ->and($post->meta_keyword)->toBe('heart health, healthy habits')
        ->and($post->is_active)->toBeTrue()
        ->and($post->feature_image)->toStartWith('storage/blog/');

    Storage::disk('public')->assertExists(Str::after($post->feature_image, 'storage/'));
});

test('creating a blog post requires a title, category, and content', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-posts-form')
        ->call('save')
        ->assertHasErrors([
            'title' => 'required',
            'slug' => 'required',
            'categoryId' => 'required',
            'content' => 'required',
        ])
        ->assertNoRedirect();

    expect(BlogPost::count())->toBe(0);
});

test('blog post slugs must be unique', function () {
    $category = BlogCategory::factory()->create();

    BlogPost::factory()->create(['slug' => 'existing-post']);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-posts-form')
        ->set('title', 'Existing Post')
        ->set('categoryId', $category->id)
        ->set('content', '<p>Article content.</p>')
        ->set('slug', 'existing-post')
        ->call('save')
        ->assertHasErrors(['slug' => 'unique'])
        ->assertNoRedirect();

    expect(BlogPost::count())->toBe(1);
});

test('an admin can edit and deactivate a blog post', function () {
    $category = BlogCategory::factory()->create([
        'title' => 'General Health',
        'slug' => 'general-health',
    ]);

    $newCategory = BlogCategory::factory()->create([
        'title' => 'Dental Care',
        'slug' => 'dental-care',
    ]);

    $post = BlogPost::factory()->for($category, 'category')->create([
        'title' => 'Old Title',
        'slug' => 'old-title',
        'content' => '<p>Old content.</p>',
        'is_active' => true,
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-posts-form', ['blogPost' => $post->id])
        ->assertSet('blogPostId', $post->id)
        ->assertSet('title', 'Old Title')
        ->assertSet('slug', 'old-title')
        ->assertSet('categoryId', $category->id)
        ->set('title', 'New Title')
        ->set('slug', 'new-title')
        ->set('categoryId', $newCategory->id)
        ->set('content', '<p>Updated content.</p>')
        ->set('isActive', false)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.blog-posts'));

    $post->refresh();

    expect($post->title)->toBe('New Title')
        ->and($post->slug)->toBe('new-title')
        ->and($post->category_id)->toBe($newCategory->id)
        ->and($post->content)->toBe('<p>Updated content.</p>')
        ->and($post->is_active)->toBeFalse();
});

test('an admin can replace a blog feature image', function () {
    Storage::fake('public');

    Storage::disk('public')->put('blog/old-cover.jpg', 'old-cover');

    $post = BlogPost::factory()->create([
        'feature_image' => 'storage/blog/old-cover.jpg',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-posts-form', ['blogPost' => $post->id])
        ->assertSet('currentFeatureImage', 'storage/blog/old-cover.jpg')
        ->set('featureImage', UploadedFile::fake()->image('new-cover.jpg'))
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.blog-posts'));

    $post->refresh();

    expect($post->feature_image)->not->toBe('storage/blog/old-cover.jpg');

    Storage::disk('public')->assertMissing('blog/old-cover.jpg');
    Storage::disk('public')->assertExists(Str::after($post->feature_image, 'storage/'));
});

test('an admin can delete a blog post and its uploaded feature image', function () {
    Storage::fake('public');

    Storage::disk('public')->put('blog/delete-me.jpg', 'delete-me');

    $post = BlogPost::factory()->create([
        'feature_image' => 'storage/blog/delete-me.jpg',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::blog-posts')
        ->call('confirmDelete', $post->id)
        ->assertSet('showDeleteModal', true)
        ->call('deletePost')
        ->assertSet('showDeleteModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('blog_posts', ['id' => $post->id]);
    Storage::disk('public')->assertMissing('blog/delete-me.jpg');
});
