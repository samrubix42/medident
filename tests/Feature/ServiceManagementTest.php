<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the service management pages', function () {
    $this->get('/admin/services')->assertRedirect('/login');
    $this->get('/admin/services/create')->assertRedirect('/login');

    $service = Service::factory()->create();

    $this->get(route('admin.services.edit', $service))->assertRedirect('/login');
});

test('an authenticated admin can view the services page and create form', function () {
    $category = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    $service = Service::factory()->for($category, 'category')->create([
        'title' => 'Dental Implants',
        'slug' => 'dental-implants',
    ]);

    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin/services')
        ->assertOk()
        ->assertSee('Services')
        ->assertSee($service->title)
        ->assertSee($category->title);

    $this->actingAs($user)
        ->get('/admin/services/create')
        ->assertOk()
        ->assertSee('Create service')
        ->assertSee('tinymce/tinymce.min.js', false);
});

test('an admin can create an active service with SEO details and an uploaded image', function () {
    Storage::fake('public');

    $category = ServiceCategory::factory()->create();

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services-form')
        ->assertSet('serviceId', null)
        ->set('title', 'Dental Implants')
        ->assertSet('slug', 'dental-implants')
        ->set('serviceCategoryId', $category->id)
        ->set('shortDescription', 'Replace missing teeth with a long-term implant solution.')
        ->set('content', '<h2>Dental implants</h2><p>An implant can replace a missing tooth.</p>')
        ->set('metaTitle', 'Dental Implants in Ghaziabad')
        ->set('metaDescription', 'Learn about dental implant treatment at MediDENT Clinic.')
        ->set('metaKeyword', 'dental implants, missing teeth')
        ->set('imageUpload', UploadedFile::fake()->image('implant.jpg'))
        ->set('isActive', true)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.services'));

    $service = Service::query()->sole();

    expect($service->title)->toBe('Dental Implants')
        ->and($service->slug)->toBe('dental-implants')
        ->and($service->service_category_id)->toBe($category->id)
        ->and($service->short_description)->toBe('Replace missing teeth with a long-term implant solution.')
        ->and($service->meta_title)->toBe('Dental Implants in Ghaziabad')
        ->and($service->meta_description)->toBe('Learn about dental implant treatment at MediDENT Clinic.')
        ->and($service->meta_keyword)->toBe('dental implants, missing teeth')
        ->and($service->is_active)->toBeTrue()
        ->and($service->image_link)->toStartWith('storage/services/');

    Storage::disk('public')->assertExists(Str::after($service->image_link, 'storage/'));
});

test('an admin can select an existing home page image for a service', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services-form')
        ->set('imageUpload', UploadedFile::fake()->image('temporary.jpg'))
        ->call('selectHomeImage', 'dental/root-canal.jpg')
        ->assertSet('imageLink', 'dental/root-canal.jpg')
        ->assertSet('imageUpload', null);
});

test('creating a service requires a title, category, short description, and content', function () {
    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services-form')
        ->call('save')
        ->assertHasErrors([
            'title' => 'required',
            'slug' => 'required',
            'serviceCategoryId' => 'required',
            'shortDescription' => 'required',
            'content' => 'required',
        ])
        ->assertNoRedirect();

    expect(Service::count())->toBe(0);
});

test('service slugs must be unique', function () {
    $category = ServiceCategory::factory()->create();

    Service::factory()->create(['slug' => 'existing-service']);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services-form')
        ->set('title', 'Existing Service')
        ->set('slug', 'existing-service')
        ->set('serviceCategoryId', $category->id)
        ->set('shortDescription', 'Existing service description.')
        ->set('content', '<p>Service content.</p>')
        ->call('save')
        ->assertHasErrors(['slug' => 'unique'])
        ->assertNoRedirect();

    expect(Service::count())->toBe(1);
});

test('an admin can edit and deactivate a service', function () {
    $category = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    $newCategory = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    $service = Service::factory()->for($category, 'category')->create([
        'title' => 'Old Service',
        'slug' => 'old-service',
        'short_description' => 'Old description.',
        'content' => '<p>Old content.</p>',
        'is_active' => true,
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services-form', ['service' => $service->id])
        ->assertSet('serviceId', $service->id)
        ->assertSet('title', 'Old Service')
        ->assertSet('slug', 'old-service')
        ->assertSet('serviceCategoryId', $category->id)
        ->set('title', 'New Service')
        ->set('slug', 'new-service')
        ->set('serviceCategoryId', $newCategory->id)
        ->set('shortDescription', 'Updated description.')
        ->set('content', '<p>Updated content.</p>')
        ->set('isActive', false)
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.services'));

    $service->refresh();

    expect($service->title)->toBe('New Service')
        ->and($service->slug)->toBe('new-service')
        ->and($service->service_category_id)->toBe($newCategory->id)
        ->and($service->short_description)->toBe('Updated description.')
        ->and($service->content)->toBe('<p>Updated content.</p>')
        ->and($service->is_active)->toBeFalse();
});

test('an admin can replace a service image and the old upload is removed', function () {
    Storage::fake('public');

    Storage::disk('public')->put('services/old-image.jpg', 'old-image');

    $service = Service::factory()->create([
        'image_link' => 'storage/services/old-image.jpg',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services-form', ['service' => $service->id])
        ->assertSet('imageLink', 'storage/services/old-image.jpg')
        ->set('imageUpload', UploadedFile::fake()->image('new-image.jpg'))
        ->call('save')
        ->assertHasNoErrors()
        ->assertRedirect(route('admin.services'));

    $service->refresh();

    expect($service->image_link)->not->toBe('storage/services/old-image.jpg');

    Storage::disk('public')->assertMissing('services/old-image.jpg');
    Storage::disk('public')->assertExists(Str::after($service->image_link, 'storage/'));
});

test('an admin can delete a service and its uploaded image', function () {
    Storage::fake('public');

    Storage::disk('public')->put('services/delete-me.jpg', 'delete-me');

    $service = Service::factory()->create([
        'image_link' => 'storage/services/delete-me.jpg',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services')
        ->call('confirmDelete', $service->id)
        ->assertSet('showDeleteModal', true)
        ->call('deleteService')
        ->assertSet('showDeleteModal', false)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('services', ['id' => $service->id]);
    Storage::disk('public')->assertMissing('services/delete-me.jpg');
});

test('services can be searched by title, slug, or category', function () {
    $physician = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    $dental = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    Service::factory()->for($physician, 'category')->create([
        'title' => 'Heart Disease',
        'slug' => 'heart-disease',
    ]);

    Service::factory()->for($dental, 'category')->create([
        'title' => 'Dental Implants',
        'slug' => 'dental-implants',
    ]);

    $this->actingAs(User::factory()->create());

    Livewire::test('admin::services')
        ->set('search', 'Heart')
        ->assertSee('Heart Disease')
        ->assertDontSee('Dental Implants');

    Livewire::test('admin::services')
        ->set('search', 'Dental Implants')
        ->assertSee('Dental Implants')
        ->assertDontSee('Heart Disease');
});
