<?php

use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the contact page is available at the contact-us route', function () {
    expect(route('contact'))->toBe(url('/contact-us'));

    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('Contact Us')
        ->assertSee('Send us a message')
        ->assertSee('SC - 296, Hapur Rd, C Block, Shastri Nagar, Ghaziabad, Uttar Pradesh 201002')
        ->assertSee('https://www.google.com/maps?q=', false)
        ->assertSee('Map showing MediDENT Multicare Clinic in Ghaziabad');
});

test('the contact form requires all fields', function () {
    Livewire::test('pages::contact')
        ->call('submit')
        ->assertHasErrors([
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ])
        ->assertSet('submitted', false);
});

test('the contact form validates the email address and phone number', function () {
    Livewire::test('pages::contact')
        ->set('name', 'Aarav Sharma')
        ->set('email', 'not-an-email')
        ->set('phone', 'not-a-phone')
        ->set('subject', 'Appointment question')
        ->set('message', 'I would like to know more about dental appointments.')
        ->call('submit')
        ->assertHasErrors([
            'email' => 'email',
            'phone' => 'regex',
        ]);
});

test('a visitor can submit a contact message', function () {
    Livewire::test('pages::contact')
        ->set('name', 'Aarav Sharma')
        ->set('email', 'aarav@example.com')
        ->set('phone', '+91 98765 43210')
        ->set('subject', 'Dental appointment')
        ->set('message', 'Please share the available dental appointment times.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true)
        ->assertSet('name', '')
        ->assertSet('email', '')
        ->assertSet('phone', '')
        ->assertSet('subject', '')
        ->assertSet('message', '');

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Aarav Sharma',
        'email' => 'aarav@example.com',
        'phone' => '+91 98765 43210',
        'subject' => 'Dental appointment',
        'message' => 'Please share the available dental appointment times.',
    ]);

    expect(ContactMessage::query()->count())->toBe(1);
});
