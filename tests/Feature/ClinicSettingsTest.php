<?php

use App\Models\ClinicSetting;
use App\Models\User;
use Database\Seeders\ClinicSettingSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the clinic settings page', function () {
    $this->get('/admin/settings')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the clinic settings page', function () {
    $this->actingAs(User::factory()->create());

    $settings = ClinicSetting::current();

    $this->get('/admin/settings')
        ->assertOk()
        ->assertSee('Clinic settings')
        ->assertSee($settings->phone)
        ->assertSee($settings->address);
});

test('an admin can update the clinic settings', function () {
    $this->actingAs(User::factory()->create());

    $settings = ClinicSetting::current();

    Livewire::test('admin::settings')
        ->assertSet('clinicName', $settings->clinic_name)
        ->set('clinicName', 'MediDENT Multicare Clinic')
        ->set('address', 'SC - 296, Shastri Nagar, Ghaziabad - 201002')
        ->set('phone', '+91 88000 23032')
        ->set('secondaryPhone', '0120-4169996')
        ->set('email', 'care@medidentclinic.com')
        ->set('openingHours', 'Mon - Sat 11:00 AM - 1:00 PM | 5:00 PM - 8:30 PM')
        ->set('whatsappNumber', '+91 88000 23032')
        ->set('facebookUrl', 'https://www.facebook.com/medident')
        ->set('instagramUrl', 'https://www.instagram.com/medident')
        ->set('linkedinUrl', 'https://www.linkedin.com/company/medident')
        ->call('save')
        ->assertHasNoErrors()
        ->assertDispatched('toast-show');

    $this->assertDatabaseHas('clinic_settings', [
        'id' => $settings->id,
        'address' => 'SC - 296, Shastri Nagar, Ghaziabad - 201002',
        'phone' => '+91 88000 23032',
        'secondary_phone' => '0120-4169996',
        'email' => 'care@medidentclinic.com',
        'whatsapp_number' => '+91 88000 23032',
        'facebook_url' => 'https://www.facebook.com/medident',
        'instagram_url' => 'https://www.instagram.com/medident',
        'linkedin_url' => 'https://www.linkedin.com/company/medident',
    ]);
});

test('the clinic setting seeder stores the clinic contact details', function () {
    $this->seed(ClinicSettingSeeder::class);

    $this->assertDatabaseHas('clinic_settings', [
        'clinic_name' => 'MediDENT Multicare Clinic',
        'address' => 'SC - 296, Hapur Rd, C Block, Shastri Nagar, Ghaziabad, Uttar Pradesh 201002',
        'phone' => '+91 88000 23032',
        'secondary_phone' => '0120-4169996',
        'opening_hours' => 'Mon - Sat 11:00 AM - 1:00 PM | 5:00 PM - 8:30 PM',
    ]);
});

test('the public website displays the saved clinic settings', function () {
    ClinicSetting::current()->update([
        'address' => 'SC - 296, Shastri Nagar, Ghaziabad - 201002',
        'phone' => '+91 99999 99999',
        'whatsapp_number' => '+91 99999 99999',
        'opening_hours' => 'Mon - Sat 11:00 AM - 1:00 PM | 5:00 PM - 8:30 PM',
    ]);

    $this->get('/')
        ->assertOk()
        ->assertSee('SC - 296, Shastri Nagar, Ghaziabad - 201002')
        ->assertSee('+91 99999 99999')
        ->assertSee('https://wa.me/919999999999', false)
        ->assertSee('https://www.facebook.com/', false)
        ->assertSee('https://www.instagram.com/', false)
        ->assertSee('https://www.linkedin.com/', false);
});
