<?php

use Illuminate\Support\Facades\Route;

Route::livewire('/', 'pages::home')->name('home');

Route::livewire('/about-us', 'pages::about')->name('about');

Route::livewire('/contact-us', 'pages::contact')->name('contact');

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

Route::livewire('/admin/settings', 'admin::settings')
    ->middleware('auth')
    ->name('admin.settings');
