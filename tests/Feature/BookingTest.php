<?php

use App\Mail\IntakeNotification;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the booking modal can be opened and closed', function () {
    Livewire::test('public.booking-modal')
        ->assertSet('showModal', false)
        ->call('openModal')
        ->assertSet('showModal', true)
        ->call('closeModal')
        ->assertSet('showModal', false);
});

test('the booking form requires all patient details', function () {
    Livewire::test('public.booking-modal')
        ->call('openModal')
        ->call('submit')
        ->assertHasErrors([
            'name' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'address' => 'required',
            'problem' => 'required',
        ])
        ->assertSet('submitted', false);
});

test('the booking form validates the phone number and age', function () {
    Livewire::test('public.booking-modal')
        ->call('openModal')
        ->set('name', 'Aarav Sharma')
        ->set('phone', 'not-a-phone')
        ->set('age', '0')
        ->set('address', '12 Market Road, Ghaziabad')
        ->set('problem', 'Tooth pain')
        ->call('submit')
        ->assertHasErrors([
            'phone' => 'regex',
            'age' => 'min',
        ]);
});

test('a patient can submit a booking request', function () {
    Mail::fake();

    Livewire::test('public.booking-modal')
        ->call('openModal')
        ->set('name', 'Aarav Sharma')
        ->set('phone', '+91 98765 43210')
        ->set('age', '32')
        ->set('address', '12 Market Road, Ghaziabad')
        ->set('problem', 'Persistent tooth pain in the lower jaw.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true);

    $this->assertDatabaseHas('appointments', [
        'name' => 'Aarav Sharma',
        'phone' => '+91 98765 43210',
        'age' => 32,
        'address' => '12 Market Road, Ghaziabad',
        'problem' => 'Persistent tooth pain in the lower jaw.',
    ]);

    Mail::assertSent(IntakeNotification::class, function (IntakeNotification $mail) {
        return $mail->hasTo('samcool3203@gmail.com')
            && $mail->heading === 'New appointment request'
            && $mail->details[2]['value'] === '32';
    });
});

test('the booking modal is available on the public pages', function () {
    $this->get('/')
        ->assertOk()
        ->assertSeeLivewire('public.booking-modal')
        ->assertSee('open-booking-modal', false);
});
