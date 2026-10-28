<?php

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('guests are redirected from the bookings page', function () {
    $this->get('/admin/bookings')
        ->assertRedirect('/login');
});

test('an authenticated admin can view the bookings page', function () {
    $user = User::factory()->create();

    $bookingOne = Appointment::factory()->create([
        'name' => 'Rahul Sharma',
        'phone' => '+91 98765 11111',
        'age' => 35,
        'address' => 'Sector 14, Ghaziabad',
        'problem' => 'Persistent tooth pain',
    ]);

    $bookingTwo = Appointment::factory()->create([
        'name' => 'Pooja Verma',
        'phone' => '+91 98765 22222',
        'age' => 28,
        'address' => 'Raj Nagar, Ghaziabad',
        'problem' => 'Routine dental checkup',
    ]);

    $this->actingAs($user)
        ->get('/admin/bookings')
        ->assertOk()
        ->assertSee('Bookings')
        ->assertSee('Appointments list')
        ->assertSee($bookingOne->name)
        ->assertSee($bookingOne->phone)
        ->assertSee($bookingTwo->name)
        ->assertSee($bookingTwo->phone)
        ->assertSee('2 total')
        ->assertSee('2 today');
});

test('bookings can be searched by patient name, phone, address, problem, or age', function () {
    $this->actingAs(User::factory()->create());

    Appointment::factory()->create([
        'name' => 'Amitabh Bachchan',
        'phone' => '+91 98111 00001',
        'age' => 81,
        'address' => 'Jalsa, Mumbai',
        'problem' => 'Dental implant query',
    ]);

    Appointment::factory()->create([
        'name' => 'Sunil Gavaskar',
        'phone' => '+91 98222 00002',
        'age' => 74,
        'address' => 'Marine Drive, Mumbai',
        'problem' => 'General physician checkup',
    ]);

    Livewire::test('admin::bookings')
        ->set('search', 'Amitabh')
        ->assertSee('Amitabh Bachchan')
        ->assertDontSee('Sunil Gavaskar');

    Livewire::test('admin::bookings')
        ->set('search', '98222')
        ->assertSee('Sunil Gavaskar')
        ->assertDontSee('Amitabh Bachchan');

    Livewire::test('admin::bookings')
        ->set('search', 'physician')
        ->assertSee('Sunil Gavaskar')
        ->assertDontSee('Amitabh Bachchan');

    Livewire::test('admin::bookings')
        ->set('search', '81')
        ->assertSee('Amitabh Bachchan')
        ->assertDontSee('Sunil Gavaskar');
});

test('bookings can be filtered by date', function () {
    $this->actingAs(User::factory()->create());

    $todayBooking = Appointment::factory()->create([
        'name' => 'Today Patient',
        'created_at' => now(),
    ]);

    $pastBooking = Appointment::factory()->create([
        'name' => 'Past Patient',
        'created_at' => now()->subMonths(2),
    ]);

    Livewire::test('admin::bookings')
        ->set('dateFilter', 'today')
        ->assertSee('Today Patient')
        ->assertDontSee('Past Patient')
        ->set('dateFilter', 'all')
        ->assertSee('Today Patient')
        ->assertSee('Past Patient');
});

test('an admin can open and close a booking detail modal', function () {
    $this->actingAs(User::factory()->create());

    $booking = Appointment::factory()->create([
        'name' => 'Kavita Krishnan',
        'phone' => '+91 98765 99999',
        'age' => 42,
        'address' => '54 Park Avenue, Ghaziabad',
        'problem' => 'Severe root canal infection and gum bleeding.',
    ]);

    Livewire::test('admin::bookings')
        ->call('openBooking', $booking->id)
        ->assertSet('showBookingModal', true)
        ->assertSet('selectedBookingId', $booking->id)
        ->assertSee('Severe root canal infection and gum bleeding.')
        ->assertSee('54 Park Avenue, Ghaziabad')
        ->call('closeBooking')
        ->assertSet('showBookingModal', false)
        ->assertSet('selectedBookingId', null);
});

test('the delete modal opens, closes, and deletes a booking', function () {
    $this->actingAs(User::factory()->create());

    $booking = Appointment::factory()->create([
        'name' => 'Vikram Seth',
    ]);

    Livewire::test('admin::bookings')
        ->call('confirmDelete', $booking->id)
        ->assertSet('showDeleteModal', true)
        ->assertSet('bookingIdBeingDeleted', $booking->id)
        ->call('cancelDelete')
        ->assertSet('showDeleteModal', false)
        ->assertSet('bookingIdBeingDeleted', null)
        ->call('confirmDelete', $booking->id)
        ->call('deleteBooking')
        ->assertSet('showDeleteModal', false)
        ->assertSet('bookingIdBeingDeleted', null)
        ->assertDispatched('toast-show');

    $this->assertDatabaseMissing('appointments', ['id' => $booking->id]);
});
