<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');

Route::livewire('/about-us', 'pages::about')->name('about');

Route::livewire('/gallery', 'pages::gallery')->name('gallery');

Route::livewire('/blog', 'pages::blog')->name('blog');

Route::livewire('/blog/{slug}', 'pages::blog-show')->name('blog.show');

Route::livewire('/contact-us', 'pages::contact')->name('contact');

Route::livewire('/best-dentist-ghaziabad', 'pages::dentist')->name('dentist');

Route::redirect('/best-dentist-in-shastri-nagar-ghaziabad', '/best-dentist-ghaziabad', 301);
Route::redirect('/dr-ratika-gupta', '/best-dentist-ghaziabad', 301);

Route::livewire('/login', 'pages::auth.login')
    ->middleware('guest')
    ->name('login');

Route::livewire('/admin', 'admin::dashboard')
    ->middleware('auth')
    ->name('admin.dashboard');

Route::livewire('/admin/reviews', 'admin::reviews')
    ->middleware('auth')
    ->name('admin.reviews');

Route::livewire('/admin/gallery-categories', 'admin::gallery-categories')
    ->middleware('auth')
    ->name('admin.gallery-categories');

Route::livewire('/admin/gallery-images', 'admin::gallery-images')
    ->middleware('auth')
    ->name('admin.gallery-images');

Route::livewire('/admin/blog-categories', 'admin::blog-categories')
    ->middleware('auth')
    ->name('admin.blog-categories');

Route::livewire('/admin/blog-posts', 'admin::blog-posts')
    ->middleware('auth')
    ->name('admin.blog-posts');

Route::livewire('/admin/blog-posts/create', 'admin::blog-posts-form')
    ->middleware('auth')
    ->name('admin.blog-posts.create');

Route::livewire('/admin/blog-posts/{blogPost}/edit', 'admin::blog-posts-form')
    ->middleware('auth')
    ->name('admin.blog-posts.edit');

Route::livewire('/admin/settings', 'admin::settings')
    ->middleware('auth')
    ->name('admin.settings');
