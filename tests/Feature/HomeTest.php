<?php

use App\Models\ClinicSetting;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the home page shows only google reviews rated 4.5 or higher', function () {
    Review::factory()->create([
        'author_title' => 'Five Star Author',
        'review_text' => 'Excellent dental care and a very comfortable visit.',
        'review_rating' => 5,
        'owner_answer' => 'Thank you for the kind feedback.',
    ]);

    Review::factory()->create([
        'author_title' => 'Four Star Author',
        'review_text' => 'Good care but below the display threshold.',
        'review_rating' => 4,
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Five Star Author')
        ->assertSee('Excellent dental care and a very comfortable visit.')
        ->assertDontSee('Thank you for the kind feedback.')
        ->assertDontSee('Response from MediDENT')
        ->assertDontSee('Four Star Author')
        ->assertDontSee('Good care but below the display threshold.');
});

test('the home page displays active services linked to their detail pages', function () {
    $physician = ServiceCategory::factory()->create([
        'title' => 'Physician',
        'slug' => 'physician',
    ]);

    $dental = ServiceCategory::factory()->create([
        'title' => 'Dental',
        'slug' => 'dental',
    ]);

    $physicianService = Service::factory()->for($physician, 'category')->create([
        'title' => 'General Medicine Review',
        'slug' => 'general-medicine-review',
        'short_description' => 'Personalised assessment for common health concerns.',
    ]);

    $dentalService = Service::factory()->for($dental, 'category')->create([
        'title' => 'Preventive Dental Cleaning',
        'slug' => 'preventive-dental-cleaning',
        'short_description' => 'Professional cleaning to support healthy teeth and gums.',
    ]);

    $inactiveService = Service::factory()->for($physician, 'category')->inactive()->create([
        'title' => 'Retired Home Service',
        'slug' => 'retired-home-service',
    ]);

    $inactiveCategory = ServiceCategory::factory()->inactive()->create([
        'title' => 'Archived Home Specialty',
        'slug' => 'archived-home-specialty',
    ]);

    $hiddenService = Service::factory()->for($inactiveCategory, 'category')->create([
        'title' => 'Hidden Home Service',
        'slug' => 'hidden-home-service',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee($physicianService->title)
        ->assertSee($physicianService->short_description)
        ->assertSee($dentalService->title)
        ->assertSee($dentalService->short_description)
        ->assertSee(route('services.show', $physicianService->slug), false)
        ->assertSee(route('services.show', $dentalService->slug), false)
        ->assertSee(route('services', ['category' => 'physician']), false)
        ->assertSee(route('services', ['category' => 'dental']), false)
        ->assertSee(route('services'), false)
        ->assertDontSee($inactiveService->title)
        ->assertDontSee($hiddenService->title)
        ->assertDontSee($inactiveCategory->title);
});

test('the home page displays frequently asked questions with clinic details', function () {
    ClinicSetting::current()->update([
        'address' => 'Test FAQ Address, Ghaziabad',
        'opening_hours' => 'Monday to Friday, 9:00 AM to 6:00 PM',
        'phone' => '+91 90000 00000',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('Frequently asked questions')
        ->assertSee('Before you visit MediDENT')
        ->assertSee('What services are available at MediDENT Multicare Clinic?')
        ->assertSee('Do I need an appointment to visit the clinic?')
        ->assertSee('Where is MediDENT Multicare Clinic located?')
        ->assertSee('Test FAQ Address, Ghaziabad')
        ->assertSee('Monday to Friday, 9:00 AM to 6:00 PM')
        ->assertSee('+91 90000 00000');
});

test('the services dropdown opens on mouse hover', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('@mouseenter="servicesOpen = true"', false)
        ->assertSee('@mouseleave="servicesOpen = false"', false);
});

test('the footer shows the Techonika credit and doctor profile links', function () {
    $this->get('/')
        ->assertOk()
        ->assertSee('Powered by')
        ->assertSee('href="https://techonika.com/"', false)
        ->assertSee('Techonika')
        ->assertSee('Best Physician in Ghaziabad')
        ->assertSee('href="'.route('physician').'"', false)
        ->assertSee('Best Dentist in Ghaziabad')
        ->assertSee('href="'.route('dentist').'"', false)
        ->assertDontSee('Medical · Diabetes · Dental Care');
});
