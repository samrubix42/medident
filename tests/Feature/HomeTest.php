<?php

use App\Models\ClinicSetting;
use App\Models\Review;
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
