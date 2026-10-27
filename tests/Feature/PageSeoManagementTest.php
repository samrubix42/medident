<?php

use App\Models\PageSeo;
use App\Models\User;
use Database\Seeders\PageSeoSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the page seo management pages', function () {
    $this->get('/admin/page-seos')->assertRedirect('/login');
    $this->get('/admin/page-seos/create')->assertRedirect('/login');

    $pageSeo = PageSeo::factory()->create();

    $this->get(route('admin.page-seos.edit', $pageSeo))->assertRedirect('/login');
});

test('an authenticated admin can view and search page seo entries', function () {
    $home = PageSeo::factory()->create([
        'page_name' => 'Home',
        'page_slug' => 'home',
        'meta_title' => 'Home SEO Title',
    ]);

    $contact = PageSeo::factory()->create([
        'page_name' => 'Contact Us',
        'page_slug' => 'contact',
        'meta_title' => 'Contact SEO Title',
    ]);

    $this->actingAs(User::factory()->create())
        ->get('/admin/page-seos')
        ->assertOk()
        ->assertSee('Page SEO')
        ->assertSee($home->page_name)
        ->assertSee($contact->page_name)
        ->assertSee($home->meta_title)
        ->assertSee($contact->meta_title);

    Livewire::test('admin::page-seos')
        ->set('search', 'Contact')
        ->assertSee($contact->page_name)
        ->assertDontSee($home->page_name);
});

test('an admin can create page seo metadata', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::page-seos-form')
        ->assertSet('pageSeoId', null)
        ->set('pageName', 'Services')
        ->assertSet('pageSlug', 'services')
        ->set('metaTitle', 'Medical & Dental Services in Ghaziabad')
        ->set('metaDescription', 'Explore the medical and dental services available at MediDENT.')
        ->set('metaKeywords', 'medical services, dental services')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.page-seos'));

    $pageSeo = PageSeo::query()->sole();

    expect($pageSeo->page_name)->toBe('Services')
        ->and($pageSeo->page_slug)->toBe('services')
        ->and($pageSeo->meta_title)->toBe('Medical & Dental Services in Ghaziabad')
        ->and($pageSeo->meta_description)->toBe('Explore the medical and dental services available at MediDENT.')
        ->and($pageSeo->meta_keywords)->toBe('medical services, dental services');
});

test('creating page seo requires a page name and key', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::page-seos-form')
        ->call('save')
        ->assertHasErrors([
            'pageName' => 'required',
            'pageSlug' => 'required',
        ])
        ->assertNoRedirect();

    expect(PageSeo::count())->toBe(0);
});

test('page seo names and keys must be unique', function () {
    PageSeo::factory()->create([
        'page_name' => 'About Us',
        'page_slug' => 'about',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::page-seos-form')
        ->set('pageName', 'About Us')
        ->set('pageSlug', 'about')
        ->call('save')
        ->assertHasErrors([
            'pageName' => 'unique',
            'pageSlug' => 'unique',
        ])
        ->assertNoRedirect();

    expect(PageSeo::count())->toBe(1);
});

test('an admin can edit page seo metadata', function () {
    $pageSeo = PageSeo::factory()->create([
        'page_name' => 'Health Blog',
        'page_slug' => 'blog',
        'meta_title' => 'Old blog title',
        'meta_description' => 'Old blog description.',
        'meta_keywords' => 'old, keywords',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::page-seos-form', ['pageSeo' => $pageSeo->id])
        ->assertSet('pageSeoId', $pageSeo->id)
        ->assertSet('pageName', 'Health Blog')
        ->assertSet('pageSlug', 'blog')
        ->set('pageName', 'Health Journal')
        ->set('pageSlug', 'health-journal')
        ->set('metaTitle', 'Health Journal | MediDENT Clinic')
        ->set('metaDescription', 'Updated health guidance from MediDENT.')
        ->set('metaKeywords', 'health advice, clinic blog')
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.page-seos'));

    $pageSeo->refresh();

    expect($pageSeo->page_name)->toBe('Health Journal')
        ->and($pageSeo->page_slug)->toBe('health-journal')
        ->and($pageSeo->meta_title)->toBe('Health Journal | MediDENT Clinic')
        ->and($pageSeo->meta_description)->toBe('Updated health guidance from MediDENT.')
        ->and($pageSeo->meta_keywords)->toBe('health advice, clinic blog');
});

test('an admin can delete page seo metadata', function () {
    $pageSeo = PageSeo::factory()->create();

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::page-seos')
        ->call('confirmDelete', $pageSeo->id)
        ->assertSet('showDeleteModal', true)
        ->call('deletePageSeo')
        ->assertSet('showDeleteModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('page_seos', ['id' => $pageSeo->id]);
});

test('the page seo seeder creates metadata for the public pages', function () {
    $this->seed(PageSeoSeeder::class);

    expect(PageSeo::count())->toBe(7)
        ->and(PageSeo::query()->where('page_slug', 'home')->exists())->toBeTrue()
        ->and(PageSeo::query()->where('page_slug', 'about')->exists())->toBeTrue()
        ->and(PageSeo::query()->where('page_slug', 'gallery')->exists())->toBeTrue()
        ->and(PageSeo::query()->where('page_slug', 'blog')->exists())->toBeTrue()
        ->and(PageSeo::query()->where('page_slug', 'services')->exists())->toBeTrue()
        ->and(PageSeo::query()->where('page_slug', 'contact')->exists())->toBeTrue()
        ->and(PageSeo::query()->where('page_slug', 'dentist')->exists())->toBeTrue();

    $this->seed(PageSeoSeeder::class);

    expect(PageSeo::count())->toBe(7);
});
