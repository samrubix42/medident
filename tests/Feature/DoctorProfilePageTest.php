<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $dental = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
        'is_active' => true,
    ]);

    $services = [
        ['title' => 'Cosmetic Dental', 'slug' => 'cosmetic-dental', 'image' => 'dental/cosmetic-dental.jpg'],
        ['title' => 'Kids Dentistry', 'slug' => 'kids-dentistry', 'image' => 'dental/KIDSDENTISTRY.jpg'],
        ['title' => 'Dental Implants', 'slug' => 'dental-implants', 'image' => 'dental/Dental-Implants.jpg'],
        ['title' => 'Painless Extraction', 'slug' => 'painless-extraction', 'image' => 'dental/painless-extraction.jpg'],
        ['title' => 'Dental Filling', 'slug' => 'dental-filling', 'image' => 'dental/dental-filling.jpg'],
        ['title' => 'Root Canal Treatment', 'slug' => 'root-canal-treatment', 'image' => 'dental/root-canal.jpg'],
    ];

    foreach ($services as $service) {
        Service::factory()->for($dental, 'category')->create([
            'title' => $service['title'],
            'slug' => $service['slug'],
            'short_description' => $service['title'].' description.',
            'image_link' => $service['image'],
        ]);
    }
});

test('the doctor profile page is available at its keyword slug', function () {
    expect(route('dentist'))->toBe(url('/best-dentist-ghaziabad'));

    $this->get(route('dentist'))->assertOk();
});

test('legacy doctor urls redirect permanently to the profile page', function (string $legacyUrl) {
    $this->get($legacyUrl)
        ->assertStatus(301)
        ->assertHeader('Location', '/best-dentist-ghaziabad');
})->with([
    '/dr-ratika-gupta',
    '/best-dentist-in-shastri-nagar-ghaziabad',
]);

test('the doctor profile page renders its canonical seo metadata', function () {
    $this->get(route('dentist'))
        ->assertOk()
        ->assertSee('<title>Dr. Ratika Gupta | Dental Surgeon in Shastri Nagar, Ghaziabad</title>', false)
        ->assertSee('<link rel="canonical" href="'.route('dentist').'">', false)
        ->assertSee('<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">', false)
        ->assertSee('<meta property="og:type" content="profile">', false)
        ->assertSee('<meta property="og:title" content="Dr. Ratika Gupta | Dental Surgeon in Shastri Nagar, Ghaziabad">', false)
        ->assertSee('dental/Dr.-Ratika-Gupta-4.jpg')
        ->assertSee('Dr. Ratika Gupta, dentist in Shastri Nagar, Ghaziabad');
});

test('the doctor profile page shows qualifications, dental services, and contact details', function () {
    $this->get(route('dentist'))
        ->assertOk()
        ->assertSee('Dental Surgeon in Shastri Nagar, Ghaziabad')
        ->assertSee('Bankey Bihari Dental College')
        ->assertSee('CCS University, Meerut')
        ->assertSee('Jaipur Dental College')
        ->assertSee('Cosmetic Dental')
        ->assertSee('Kids Dentistry')
        ->assertSee('Dental Implants')
        ->assertSee('Painless Extraction')
        ->assertSee('Dental Filling')
        ->assertSee('Root Canal Treatment')
        ->assertSee('dental/cosmetic-dental.jpg')
        ->assertSee('SC - 296, Hapur Rd')
        ->assertSee('+91-8290582582')
        ->assertSee('Monday–Saturday: 11:00 AM–1:00 PM and 5:00 PM–8:00 PM')
        ->assertSee('Who is Dr. Ratika Gupta?');
});

test('the doctor profile page only shows active dental services', function () {
    $dental = ServiceCategory::where('slug', 'dental')->sole();

    $physician = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    Service::factory()->for($dental, 'category')->inactive()->create([
        'title' => 'Inactive Dental Service',
    ]);

    Service::factory()->for($physician, 'category')->create([
        'title' => 'Physician Consultation',
    ]);

    $this->get(route('dentist'))
        ->assertOk()
        ->assertSee('Cosmetic Dental')
        ->assertDontSee('Inactive Dental Service')
        ->assertDontSee('Physician Consultation');
});

test('the doctor profile page outputs structured data for search engines', function () {
    $html = $this->get(route('dentist'))->assertOk()->getContent();

    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);

    expect($matches)->not->toBeEmpty();

    $schema = json_decode($matches[1], true, 512, JSON_THROW_ON_ERROR);
    $graph = collect($schema['@graph'])->keyBy('@type');

    expect($graph)->toHaveKeys(['WebSite', 'WebPage', 'Person', 'Dentist', 'BreadcrumbList', 'FAQPage'])
        ->and($graph['Person']['name'])->toBe('Dr. Ratika Gupta')
        ->and($graph['Person']['jobTitle'])->toBe('Dental Surgeon')
        ->and($graph['Person']['hasCredential'])->toHaveCount(2)
        ->and($graph['Person']['knowsAbout'])->toHaveCount(6)
        ->and($graph['Dentist']['name'])->toBe('MediDENT Multicare Clinic')
        ->and($graph['Dentist']['hasOfferCatalog']['itemListElement'])->toHaveCount(6)
        ->and($graph['FAQPage']['mainEntity'])->toHaveCount(6);
});

test('the about page links to the doctor profile page', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('View full profile')
        ->assertSee('href="'.route('dentist').'"', false);
});
