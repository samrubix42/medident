<?php

use App\Models\Appointment;
use App\Models\ContactMessage;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('the admin dashboard displays live clinic activity', function () {
    $user = User::factory()->create();

    Appointment::factory()->create([
        'name' => 'Aarav Sharma',
        'phone' => '+91 98765 43210',
        'problem' => 'Severe tooth pain',
    ]);

    Appointment::factory()->create([
        'name' => 'Meera Patel',
        'problem' => 'Dental check-up',
    ]);

    ContactMessage::factory()->create([
        'name' => 'Rohit Verma',
        'subject' => 'Root canal question',
    ]);

    ContactMessage::factory()->read()->create([
        'name' => 'Sara Khan',
        'subject' => 'Clinic timings',
    ]);

    Service::factory()->create();
    Service::factory()->inactive()->create();

    Review::factory()->create(['review_rating' => 4]);
    Review::factory()->create(['review_rating' => 5]);

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk()
        ->assertSee('Aarav Sharma')
        ->assertSee('+91 98765 43210')
        ->assertSee('Severe tooth pain')
        ->assertSee('Meera Patel')
        ->assertSee('Rohit Verma')
        ->assertSee('Root canal question')
        ->assertSeeInOrder(["Today's appointments", '2', '2 this week'])
        ->assertSeeInOrder(['Unread inquiries', '1', '2 total messages'])
        ->assertSeeInOrder(['Active services', '1', '2 total services'])
        ->assertSeeInOrder(['Google reviews', '2', '4.5 average rating']);
});

test('the admin dashboard displays empty states when there is no activity', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin')
        ->assertOk()
        ->assertSee('No appointment requests yet')
        ->assertSee('No inquiries yet')
        ->assertSee('0 total messages')
        ->assertSee('0 total services')
        ->assertSee('No reviews yet');
});
