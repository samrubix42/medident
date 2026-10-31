<?php

use App\Models\PageSeo;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('stored page seo metadata is applied to public pages', function (string $pageSlug, string $routeName) {
    $title = 'SEO Title for '.$pageSlug;
    $description = 'SEO description for the '.$pageSlug.' page.';
    $keywords = 'keyword-'.$pageSlug.', MediDENT clinic';

    PageSeo::factory()->create([
        'page_name' => ucfirst($pageSlug),
        'page_slug' => $pageSlug,
        'meta_title' => $title,
        'meta_description' => $description,
        'meta_keywords' => $keywords,
    ]);

    $this->get(route($routeName))
        ->assertOk()
        ->assertSee('<title>'.$title.'</title>', false)
        ->assertSee('<meta name="description" content="'.$description.'">', false)
        ->assertSee('<meta name="keywords" content="'.$keywords.'">', false);
})->with([
    'home' => ['home', 'home'],
    'about' => ['about', 'about'],
    'gallery' => ['gallery', 'gallery'],
    'blog' => ['blog', 'blog'],
    'services' => ['services', 'services'],
    'contact' => ['contact', 'contact'],
    'dentist' => ['dentist', 'dentist'],
    'physician' => ['physician', 'physician'],
    'gastroenterologist' => ['gastroenterologist', 'gastroenterologist'],
]);

test('public pages use their default metadata when no page seo entry exists', function () {
    expect(PageSeo::count())->toBe(0);

    $this->get(route('about'))
        ->assertOk()
        ->assertSee('<title>About MediDENT Multicare Clinic | Doctors in Ghaziabad</title>', false)
        ->assertSee('<meta name="description" content="Meet the doctors and learn about MediDENT Multicare Clinic&#039;s approach to general medicine, diabetes care, pediatric gastroenterology and family dentistry in Shastri Nagar, Ghaziabad.">', false)
        ->assertSee('<meta name="keywords" content="about MediDENT Multicare Clinic, doctors in Shastri Nagar Ghaziabad, Dr Divya Prakash, Dr Ratika Gupta, Dr Megha Rustagi, pediatric gastroenterologist Ghaziabad, clinic in Ghaziabad">', false);
});
