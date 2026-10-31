<?php

use App\Mail\IntakeNotification;
use App\Models\ContactMessage;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the contact page is available at the contact-us route', function () {
    expect(route('contact'))->toBe(url('/contact-us'));

    $this->get(route('contact'))
        ->assertOk()
        ->assertSee('Contact Us')
        ->assertSee('Send us a message')
        ->assertSee('SC - 296, Hapur Rd, C Block, Shastri Nagar, Ghaziabad, Uttar Pradesh 201002')
        ->assertSee('https://www.google.com/maps/embed?pb=', false)
        ->assertSee('0x390cf175f325dba9%3A0x24bb042cbe7d8a2f', false)
        ->assertSee('Map showing MediDENT Multicare Clinic in Ghaziabad');
});

test('the contact form requires all fields', function () {
    Livewire::test('pages::contact')
        ->call('submit')
        ->assertHasErrors([
            'name' => 'required',
            'phone' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ])
        ->assertHasNoErrors(['email'])
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
    Mail::fake();

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
        'is_read' => false,
    ]);

    expect(ContactMessage::query()->count())->toBe(1);

    Mail::assertSent(IntakeNotification::class, function (IntakeNotification $mail) {
        return $mail->hasTo('samcool3203@gmail.com')
            && $mail->heading === 'New contact message';
    });
});

test('a visitor can submit a contact message without an email address', function () {
    Mail::fake();

    Livewire::test('pages::contact')
        ->set('name', 'Aarav Sharma')
        ->set('phone', '+91 98765 43210')
        ->set('subject', 'Clinic timings')
        ->set('message', 'Please share the clinic opening hours for this week.')
        ->call('submit')
        ->assertHasNoErrors()
        ->assertSet('submitted', true);

    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Aarav Sharma',
        'email' => null,
        'phone' => '+91 98765 43210',
        'is_read' => false,
    ]);

    Mail::assertSent(IntakeNotification::class, function (IntakeNotification $mail) {
        return $mail->hasTo('samcool3203@gmail.com')
            && $mail->details[1]['value'] === 'Not provided';
    });
});

test('contact notifications render the clinic email design and submitted details', function () {
    $mail = new IntakeNotification(
        'New contact message',
        'A visitor sent a message through the MediDENT contact form.',
        [
            ['label' => 'Name', 'value' => 'Aarav Sharma'],
            ['label' => 'Message', 'value' => '<b>Please call me about an appointment.</b>'],
        ],
        'New contact message - MediDENT',
    );

    $mail->assertHasSubject('New contact message - MediDENT');
    $mail->assertSeeInHtml('MEDIDENT MULTICARE CLINIC');
    $mail->assertSeeInHtml('Aarav Sharma');
    $mail->assertSeeInHtml('text-align: left !important');
    $mail->assertSeeInHtml('<b>Please call me about an appointment.</b>');
    expect($mail->render())->not->toContain('<b>Please call me about an appointment.</b>');
    $mail->assertSeeInText('MediDENT Multicare Clinic');
});
