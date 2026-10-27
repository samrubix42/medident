<?php

use App\Models\BlogCategory;
use App\Models\BlogPost;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the blog page lists active articles in active categories', function () {
    $category = BlogCategory::factory()->create([
        'title' => 'Heart Health',
        'slug' => 'heart-health',
    ]);

    $published = BlogPost::factory()->for($category, 'category')->create([
        'title' => 'Everyday Heart Health Habits',
        'slug' => 'everyday-heart-health-habits',
    ]);

    $inactivePost = BlogPost::factory()->for($category, 'category')->inactive()->create([
        'title' => 'Inactive Article',
        'slug' => 'inactive-article',
    ]);

    $inactiveCategory = BlogCategory::factory()->inactive()->create([
        'title' => 'Archived Topics',
        'slug' => 'archived-topics',
    ]);

    $postInInactiveCategory = BlogPost::factory()->for($inactiveCategory, 'category')->create([
        'title' => 'Archived Article',
        'slug' => 'archived-article',
    ]);

    expect(route('blog'))->toBe(url('/blog'));

    $this->get(route('blog'))
        ->assertOk()
        ->assertSee('Health Journal')
        ->assertSee($published->title)
        ->assertSee($category->title)
        ->assertDontSee($inactivePost->title)
        ->assertDontSee($postInInactiveCategory->title)
        ->assertDontSee($inactiveCategory->title);
});

test('a visitor can filter blog articles by category slug', function () {
    $dental = BlogCategory::factory()->create([
        'title' => 'Dental Care',
        'slug' => 'dental-care',
    ]);

    $heart = BlogCategory::factory()->create([
        'title' => 'Heart Health',
        'slug' => 'heart-health',
    ]);

    $dentalPost = BlogPost::factory()->for($dental, 'category')->create([
        'title' => 'Childrens Dental Care Guide',
        'slug' => 'childrens-dental-care-guide',
    ]);

    $heartPost = BlogPost::factory()->for($heart, 'category')->create([
        'title' => 'Heart Health Basics',
        'slug' => 'heart-health-basics',
    ]);

    Livewire::test('pages::blog')
        ->assertSee($dentalPost->title)
        ->assertSee($heartPost->title)
        ->call('selectCategory', 'dental-care')
        ->assertSet('category', 'dental-care')
        ->assertSee($dentalPost->title)
        ->assertDontSee($heartPost->title)
        ->call('selectCategory', 'all')
        ->assertSee($heartPost->title);
});

test('a blog article page renders the stored html content and metadata', function () {
    $category = BlogCategory::factory()->create([
        'title' => 'Dental Care',
        'slug' => 'dental-care',
    ]);

    $post = BlogPost::factory()->for($category, 'category')->create([
        'title' => 'Recovering After a Root Canal',
        'slug' => 'recovering-after-a-root-canal',
        'meta_title' => 'Root Canal Recovery Guide',
        'meta_description' => 'A clear guide to the days after treatment.',
        'meta_keyword' => 'root canal, dental care',
        'content' => '<h2>Recovery at home</h2><p>Rest is <strong>important</strong> after treatment.</p>',
    ]);

    BlogPost::factory()->for($category, 'category')->create([
        'title' => 'Another Dental Article',
        'slug' => 'another-dental-article',
    ]);

    expect(route('blog.show', $post->slug))->toBe(url('/blog/'.$post->slug));

    $this->get(route('blog.show', $post->slug))
        ->assertOk()
        ->assertSee('<title>Root Canal Recovery Guide</title>', false)
        ->assertSee('<meta name="description" content="A clear guide to the days after treatment.">', false)
        ->assertSee('<meta name="keywords" content="root canal, dental care">', false)
        ->assertSee('<meta property="article:published_time"', false)
        ->assertSee('"@type":"BlogPosting"', false)
        ->assertSee('"@type":"BreadcrumbList"', false)
        ->assertSee($post->title)
        ->assertSee('Recovery at home')
        ->assertSee('<strong>important</strong>', false)
        ->assertSee('Related articles');
});

test('inactive articles and articles in inactive categories are not accessible', function () {
    $inactivePost = BlogPost::factory()->inactive()->create([
        'slug' => 'private-draft',
    ]);

    $inactiveCategory = BlogCategory::factory()->inactive()->create([
        'slug' => 'archived-topics',
    ]);

    $postInInactiveCategory = BlogPost::factory()->for($inactiveCategory, 'category')->create([
        'slug' => 'archived-post',
    ]);

    $this->get(route('blog.show', $inactivePost->slug))->assertNotFound();
    $this->get(route('blog.show', $postInInactiveCategory->slug))->assertNotFound();
});
