<?php

use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the about page is available at the about-us slug', function () {
    expect(route('about'))->toBe(url('/about-us'));
});

test('the about page shows the clinic story, statistics, and doctors', function () {
    $this->get(route('about'))
        ->assertOk()
        ->assertSee('About Us')
        ->assertSee('Medical, diabetes and')
        ->assertSee('5000+')
        ->assertSee('15')
        ->assertSee('Dr. Divya Prakash')
        ->assertSee('Diabetologist &amp; General Physician', false)
        ->assertSee('Dr. Ratika Gupta')
        ->assertSee('Dental Surgeon &amp; Pediatric Dentist', false)
        ->assertSee('Dr. Megha Rustagi')
        ->assertSee('Pediatric Gastroenterologist &amp; Hepatologist', false)
        ->assertSee('doctors/Dr.-Divya-Prakash.jpeg')
        ->assertSee('doctors/Dr.-Megha-Rustagi.jpeg')
        ->assertSee('doctors/Dr.-RatikaGupta.jpg');
});
