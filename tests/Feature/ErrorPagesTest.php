<?php

use Illuminate\Support\Facades\Route;

beforeEach(function () {
    config(['app.debug' => false]);

    Route::get('/_test/errors/{code}', fn (int $code) => abort($code));
});

test('custom error pages render the branded layout', function (int $status, string $title) {
    $this->get("/_test/errors/{$status}")
        ->assertStatus($status)
        ->assertSee("<title>{$status} {$title} | MediDENT Multicare Clinic</title>", false)
        ->assertSee('Error '.$status)
        ->assertSee($title)
        ->assertSee('MediDENT Multicare Clinic')
        ->assertSee('Go to homepage')
        ->assertSee('Contact the clinic')
        ->assertSee('<meta name="robots" content="noindex, nofollow">', false)
        ->assertSee('href="'.route('home').'"', false)
        ->assertSee('href="'.route('contact').'"', false);
})->with([
    [400, 'Bad Request'],
    [401, 'Authentication Required'],
    [402, 'Payment Required'],
    [403, 'Access Denied'],
    [404, 'Page Not Found'],
    [405, 'Method Not Allowed'],
    [419, 'Page Expired'],
    [429, 'Too Many Requests'],
    [500, 'Server Error'],
    [503, 'Service Unavailable'],
]);
