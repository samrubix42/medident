<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the pediatric gastroenterologist profile page is available at its keyword slug', function () {
    expect(route('gastroenterologist'))->toBe(url('/pediatric-gastroenterologist-ghaziabad'));

    $this->get(route('gastroenterologist'))->assertOk();
});

test('the legacy doctor url redirects permanently to the profile page', function () {
    $this->get('/dr-megha-rustagi')
        ->assertStatus(301)
        ->assertHeader('Location', '/pediatric-gastroenterologist-ghaziabad');
});

test('the gastroenterologist profile page renders its canonical seo metadata', function () {
    $this->get(route('gastroenterologist'))
        ->assertOk()
        ->assertSee('<title>Dr. Megha Rustagi | Pediatric Gastroenterologist in Ghaziabad</title>', false)
        ->assertSee('<link rel="canonical" href="'.route('gastroenterologist').'">', false)
        ->assertSee('<meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">', false)
        ->assertSee('<meta property="og:type" content="profile">', false)
        ->assertSee('<meta property="og:title" content="Dr. Megha Rustagi | Pediatric Gastroenterologist in Ghaziabad">', false)
        ->assertSee('doctors/Dr.-Megha-Rustagi.jpeg')
        ->assertSee('Dr. Megha Rustagi, pediatric gastroenterologist and hepatologist in Ghaziabad');
});

test('the gastroenterologist profile page shows qualifications, experience, research and awards', function () {
    $this->get(route('gastroenterologist'))
        ->assertOk()
        ->assertSee('Pediatric Gastroenterologist &amp; Hepatologist in Ghaziabad', false)
        ->assertSee('Indraprastha Apollo Hospital, New Delhi')
        ->assertSee('Bai Jerbai Wadia Hospital, Mumbai')
        ->assertSee('Krishna Institute of Medical Sciences, Karad, Maharashtra')
        ->assertSee('Jhalawar Medical College, Jhalawar, Rajasthan')
        ->assertSee('Kalawati Saran Children’s Hospital (LHMC) & Chacha Nehru Bal Chikitsalaya, Delhi')
        ->assertSee('Recurrent abdominal pain')
        ->assertSee('Inflammatory bowel disease')
        ->assertSee('Pediatric gastrointestinal endoscopy')
        ->assertSee('Plummer Vinson Syndrome and role of Endoscopic Balloon dilatation in a 4 year old child')
        ->assertSee('Journal of Pediatric Gastroenterology Reports')
        ->assertSee('Young Investigator Award')
        ->assertSee('First Prize')
        ->assertSee('Second Prize')
        ->assertSee('SC - 296, Hapur Rd')
        ->assertSee('+91 88000 23032')
        ->assertSee('Who is Dr. Megha Rustagi?');
});

test('the gastroenterologist profile page outputs structured data for search engines', function () {
    $html = $this->get(route('gastroenterologist'))->assertOk()->getContent();

    preg_match('/<script type="application\/ld\+json">(.*?)<\/script>/s', $html, $matches);

    expect($matches)->not->toBeEmpty();

    $schema = json_decode($matches[1], true, 512, JSON_THROW_ON_ERROR);
    $graph = collect($schema['@graph'])->keyBy('@type');

    expect($graph)->toHaveKeys(['WebSite', 'WebPage', 'Person', 'Physician', 'BreadcrumbList', 'FAQPage'])
        ->and($graph['Person']['name'])->toBe('Dr. Megha Rustagi')
        ->and($graph['Person']['jobTitle'])->toBe('Pediatric Gastroenterologist & Hepatologist')
        ->and($graph['Person']['hasCredential'])->toHaveCount(4)
        ->and($graph['Person']['knowsAbout'])->toHaveCount(8)
        ->and($graph['Physician']['name'])->toBe('MediDENT Multicare Clinic')
        ->and($graph['FAQPage']['mainEntity'])->toHaveCount(6);
});

test('the about page links to the gastroenterologist profile page', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('Dr. Megha Rustagi')
        ->assertSee('href="'.route('gastroenterologist').'"', false)
        ->assertSee('View Profile');
});
