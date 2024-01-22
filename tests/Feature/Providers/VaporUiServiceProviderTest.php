<?php

use App\Models\User;

it('can access vapor ui if user is authorized', function () {
    $allowedUsers = [
        User::factory()->create(['email' => 'hi@raullg.com']),
    ];

    foreach ($allowedUsers as $user) {
        $this
            ->actingAs($user)
            ->get('/vapor-ui')
            // expects this exception since it does not run in a vapor environment
            ->assertSee('Unable to detect [vapor-ui.project]. Please deploy your project, and visit this URI on a Vapor powered environment.');
    }
});

it('cannot access vapor ui if user is not authorized', function () {
    $this
        ->actingAs(User::factory()->create())
        ->get('/vapor-ui')
        ->assertForbidden();
});
