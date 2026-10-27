<?php

use App\Models\BlogPost;
use Database\Seeders\BlogCategorySeeder;
use Database\Seeders\BlogPostSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the blog seeders import the live articles with local feature images', function () {
    $this->seed([
        BlogCategorySeeder::class,
        BlogPostSeeder::class,
    ]);

    $posts = BlogPost::query()->with('category')->get();

    expect($posts)->toHaveCount(8);

    $posts->each(function (BlogPost $post): void {
        expect($post->feature_image)->not->toBeNull()
            ->and(file_exists(public_path($post->feature_image)))->toBeTrue()
            ->and($post->content)->toContain('<p>')
            ->and($post->category)->not->toBeNull()
            ->and($post->is_active)->toBeTrue();
    });

    $dentalPost = $posts->firstWhere('slug', 'top-10-dental-care-tips-to-improve-your-oral-hygiene-routine');

    expect($dentalPost)->not->toBeNull()
        ->and($dentalPost->title)->toBe('Top 10 Dental Care Tips to Improve Your Oral Hygiene Routine')
        ->and($dentalPost->category->slug)->toBe('dental-care');
});

test('the blog post seeder is idempotent', function () {
    $this->seed([
        BlogCategorySeeder::class,
        BlogPostSeeder::class,
        BlogPostSeeder::class,
    ]);

    expect(BlogPost::query()->count())->toBe(8);
});
