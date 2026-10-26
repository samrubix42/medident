<?php

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
