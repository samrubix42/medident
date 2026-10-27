<?php

use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

beforeEach(function () {
    $physician = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
        'is_active' => true,
    ]);

    $services = [
        ['title' => 'General Diseases', 'slug' => 'general-diseases', 'image' => 'images/general-diseases.jpg'],
        ['title' => 'Gastrointestinal Diseases', 'slug' => 'gastrointestinal-diseases', 'image' => 'images/gastro.jpg'],
        ['title' => 'Heart Disease', 'slug' => 'heart-disease', 'image' => 'images/heart.jpg'],
        ['title' => 'Thyroid Disorders', 'slug' => 'thyroid-disorders', 'image' => 'images/throid.jpg'],
        ['title' => 'Respiratory Diseases', 'slug' => 'respiratory-diseases', 'image' => 'images/respiratory.jpg'],
        ['title' => 'Vaccination', 'slug' => 'vaccination', 'image' => 'images/vaccination.jpg'],
    ];

    foreach ($services as $service) {
        Service::factory()->for($physician, 'category')->create([
            'title' => $service['title'],
            'slug' => $service['slug'],
            'short_description' => $service['title'].' description.',
            'image_link' => $service['image'],
        ]);
    }
});

test('the physician profile page is available at its keyword slug', function () {
    expect(route('physician'))->toBe(url('/best-physician-ghaziabad'));

    $this->get(route('physician'))->assertOk();
});

test('the physician profile page renders its canonical seo metadata', function () {
    $this->get(route('physician'))
        ->assertOk()
        ->assertSee('<title>Best Physician Doctor in Ghaziabad | Dr. Divya Prakash</title>', false)
        ->assertSee('<link rel="canonical" href="'.route('physician').'">', false)
        ->assertSee('<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">', false)
        ->assertSee('<meta property="og:type" content="profile">', false)
        ->assertSee('<meta property="og:title" content="Best Physician Doctor in Ghaziabad | Dr. Divya Prakash">', false)
        ->assertSee('doctors/Dr.-Divya-Prakash-2.jpg')
        ->assertSee('Dr. Divya Prakash, diabetologist and general physician in Ghaziabad');
});

test('the physician profile page shows qualifications, services, associations, and contact details', function () {
    $this->get(route('physician'))
        ->assertOk()
        ->assertSee('Best Physician Doctor &amp; Consultant in Ghaziabad', false)
        ->assertSee('Diabetologist &amp; General Physician', false)
        ->assertSee('Rajiv Gandhi University of Health Sciences, Karnataka')
        ->assertSee('Maharaja Agrasen Hospital, Punjabi Bagh, New Delhi')
        ->assertSee('Maulana Azad Medical College (IGNOU), New Delhi')
        ->assertSee('Yashoda Hospital &amp; Cancer Institute, Sanjay Nagar, Ghaziabad', false)
        ->assertSee('Sarvodya Hospital, Kavi Nagar, D3 (Near Diamond Flyover)')
        ->assertSee('Gargi Hospital, Sector-9, Raj Nagar, Ghaziabad')
        ->assertSee('General Diseases')
        ->assertSee('Gastrointestinal Diseases')
        ->assertSee('Heart Disease')
        ->assertSee('Thyroid Disorders')
        ->assertSee('Respiratory Diseases')
        ->assertSee('Vaccination')
        ->assertSee('images/general-diseases.jpg')
        ->assertSee('Mon to Sat: 5:00 PM to 8:30 PM')
        ->assertSee('Sunday: 10:00 AM to 12:00 noon')
        ->assertSee('Mon to Sat: 11:00 AM to 3:00 PM')
        ->assertSee('+91-8800023032')
        ->assertSee('0120-4169996')
        ->assertSee('Who is Dr. Divya Prakash?');
});

test('the physician profile page only shows active physician services', function () {
    $physician = ServiceCategory::where('slug', 'physician')->sole();

    $dental = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    Service::factory()->for($physician, 'category')->inactive()->create([
        'title' => 'Inactive Physician Service',
    ]);

    Service::factory()->for($dental, 'category')->create([
        'title' => 'Dental Service',
    ]);

    $this->get(route('physician'))
        ->assertOk()
        ->assertSee('General Diseases')
        ->assertDontSee('Inactive Physician Service')
        ->assertDontSee('Dental Service');
});

test('the physician profile page outputs structured data for search engines', function () {
    $html = $this->get(route('physician'))->assertOk()->getContent();

    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);

    expect($matches)->not->toBeEmpty();

    $schema = json_decode($matches[1], true, 512, JSON_THROW_ON_ERROR);
    $graph = collect($schema['@graph'])->keyBy('@type');

    expect($graph)->toHaveKeys(['WebSite', 'WebPage', 'Person', 'Physician', 'Hospital', 'BreadcrumbList', 'FAQPage'])
        ->and($graph['Person']['name'])->toBe('Dr. Divya Prakash')
        ->and($graph['Person']['jobTitle'])->toBe('Diabetologist & General Physician')
        ->and($graph['Person']['hasCredential'])->toHaveCount(4)
        ->and($graph['Person']['knowsAbout'])->toHaveCount(6)
        ->and($graph['Physician']['name'])->toBe('MediDENT Multicare Clinic')
        ->and($graph['Physician']['hasOfferCatalog']['itemListElement'])->toHaveCount(6)
        ->and($graph['FAQPage']['mainEntity'])->toHaveCount(6);
});

test('the about page links to the physician profile page', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('href="'.route('physician').'"', false)
        ->assertSee('View full profile');
});
