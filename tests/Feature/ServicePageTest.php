<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the services page lists active services in active categories', function () {
    $physician = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    $activeService = Service::factory()->for($physician, 'category')->create([
        'title' => 'General Medicine Consultation',
        'slug' => 'general-medicine-consultation',
        'short_description' => 'Assessment and guidance for everyday health concerns.',
    ]);

    $inactiveService = Service::factory()->for($physician, 'category')->inactive()->create([
        'title' => 'Retired Medical Service',
        'slug' => 'retired-medical-service',
    ]);

    $inactiveCategory = ServiceCategory::factory()->inactive()->create([
        'title' => 'Archived Specialty',
        'slug' => 'archived-specialty',
    ]);

    $archivedService = Service::factory()->for($inactiveCategory, 'category')->create([
        'title' => 'Archived Service',
        'slug' => 'archived-service',
    ]);

    expect(route('services'))->toBe(url('/services'));

    $this->get(route('services'))
        ->assertOk()
        ->assertSee('Find the care you need.')
        ->assertSee($activeService->title)
        ->assertSee($activeService->short_description)
        ->assertSee($physician->title)
        ->assertSee(route('services.show', $activeService->slug), false)
        ->assertDontSee($inactiveService->title)
        ->assertDontSee($archivedService->title)
        ->assertDontSee($inactiveCategory->title);
});

test('a visitor can filter services by category from the page or a query parameter', function () {
    $dental = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    $physician = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    $dentalService = Service::factory()->for($dental, 'category')->create([
        'title' => 'Cosmetic Dental Treatment',
        'slug' => 'cosmetic-dental-treatment',
    ]);

    $physicianService = Service::factory()->for($physician, 'category')->create([
        'title' => 'Heart Health Consultation',
        'slug' => 'heart-health-consultation',
    ]);

    $this->get(route('services', ['category' => 'dental']))
        ->assertOk()
        ->assertSee('wire:click="selectCategory(\'dental\')"', false)
        ->assertDontSee("wire:click='selectCategory(", false)
        ->assertSee($dentalService->title)
        ->assertDontSee($physicianService->title);

    Livewire::test('pages::services')
        ->assertSee($dentalService->title)
        ->assertSee($physicianService->title)
        ->call('selectCategory', 'dental')
        ->assertSet('category', 'dental')
        ->assertSee($dentalService->title)
        ->assertDontSee($physicianService->title)
        ->call('selectCategory', 'all')
        ->assertSet('category', 'all')
        ->assertSee($physicianService->title);
});

test('a service page renders the stored html content, metadata, related services, and schema', function () {
    $category = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    $service = Service::factory()->for($category, 'category')->create([
        'title' => 'Root Canal Treatment',
        'slug' => 'root-canal-treatment',
        'short_description' => 'Treatment for an infected or severely decayed tooth.',
        'content' => '<h2>Relieving tooth pain</h2><p>Root canal treatment is <strong>planned carefully</strong>.</p><table><tbody><tr><th>Visit</th><td>Evaluation</td></tr></tbody></table>',
        'meta_title' => 'Root Canal Treatment in Ghaziabad',
        'meta_description' => 'Learn how root canal treatment can relieve pain and save an infected tooth.',
        'meta_keyword' => 'root canal treatment, dental care',
    ]);

    $relatedService = Service::factory()->for($category, 'category')->create([
        'title' => 'Dental Filling',
        'slug' => 'dental-filling',
    ]);

    expect(route('services.show', $service->slug))->toBe(url('/services/'.$service->slug));

    $response = $this->get(route('services.show', $service->slug))
        ->assertOk()
        ->assertSee('<title>Root Canal Treatment in Ghaziabad</title>', false)
        ->assertSee('<meta name="description" content="Learn how root canal treatment can relieve pain and save an infected tooth.">', false)
        ->assertSee('<meta name="keywords" content="root canal treatment, dental care">', false)
        ->assertSee('<link rel="canonical" href="'.route('services.show', $service->slug).'">', false)
        ->assertSee($service->title)
        ->assertSee($service->short_description)
        ->assertSee('Relieving tooth pain')
        ->assertSee('<strong>planned carefully</strong>', false)
        ->assertSee('<table>', false)
        ->assertSee($relatedService->title)
        ->assertSee('Related services');

    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $response->getContent(), $matches);

    expect($matches)->not->toBeEmpty();

    $schema = json_decode($matches[1], true, 512, JSON_THROW_ON_ERROR);
    $graph = collect($schema['@graph'])->keyBy('@type');

    expect($graph)->toHaveKeys(['WebSite', 'WebPage', 'MedicalProcedure', 'MedicalClinic', 'BreadcrumbList'])
        ->and($graph['MedicalProcedure']['name'])->toBe($service->title)
        ->and($graph['MedicalProcedure']['description'])->toBe($service->meta_description);
});

test('inactive services and services in inactive categories are not accessible', function () {
    $inactiveService = Service::factory()->inactive()->create([
        'slug' => 'inactive-service',
    ]);

    $inactiveCategory = ServiceCategory::factory()->inactive()->create([
        'slug' => 'inactive-category',
    ]);

    $serviceInInactiveCategory = Service::factory()->for($inactiveCategory, 'category')->create([
        'slug' => 'hidden-service',
    ]);

    $this->get(route('services.show', $inactiveService->slug))->assertNotFound();
    $this->get(route('services.show', $serviceInInactiveCategory->slug))->assertNotFound();
});
