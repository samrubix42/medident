<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

uses(RefreshDatabase::class);

test('the login page renders', function () {
    $this->get('/login')
        ->assertOk()
        ->assertSee('Sign in to your account');

    Livewire::test('pages::auth.login')
        ->assertSet('email', '')
        ->assertSet('password', '');
});

test('guests are redirected from the admin dashboard', function () {
    $this->get('/admin')
        ->assertRedirect('/login');
});

test('authenticated users can view the admin dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get('/admin')
        ->assertOk()
        ->assertSee('Dashboard')
        ->assertSee('Recent appointments');
});

test('the admin sidebar renders separate review and inquiry links plus grouped submenus', function () {
    $this->actingAs(User::factory()->create())
        ->get('/admin')
        ->assertOk()
        ->assertSee('Reviews')
        ->assertSee('Inquiries')
        ->assertSee('All services')
        ->assertSee('Posts')
        ->assertSee('Images')
        ->assertSee('Page SEO')
        ->assertSee('Settings')
        ->assertSee('aria-controls="admin-services-menu"', false)
        ->assertSee('x-show="servicesOpen"', false)
        ->assertDontSee('Patient Engagement')
        ->assertDontSee('Coming soon');
});

test('an admin can sign in with valid credentials', function () {
    User::factory()->create([
        'email' => 'admin@medidentclinic.com',
        'password' => 'password',
    ]);

    Livewire::test('pages::auth.login')
        ->set('email', 'admin@medidentclinic.com')
        ->set('password', 'password')
        ->call('login')
        ->assertRedirect(route('admin.dashboard'));
});

test('invalid credentials are rejected', function () {
    Livewire::test('pages::auth.login')
        ->set('email', 'admin@medidentclinic.com')
        ->set('password', 'wrong-password')
        ->call('login')
        ->assertHasErrors('email');
});

test('an admin can sign out', function () {
    $user = User::factory()->create();

    $this->actingAs($user);

    Livewire::test('admin.header')
        ->call('logout')
        ->assertRedirect(route('login'));

    expect(auth()->check())->toBeFalse();
});
