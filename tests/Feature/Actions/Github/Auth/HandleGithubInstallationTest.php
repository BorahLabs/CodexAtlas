<?php

use App\Models\User;

it('does not creates the source code account when using an invalid installation id', function () {
    $installationId = '1';
    $code = '1';
    $user = User::factory()->inPayAsYouGoMode()->create();
    $this
        ->actingAs($user)
        ->get(route('github.installation', ['installation_id' => $installationId, 'code' => $code]))
        ->assertInternalServerError();
});

it('creates the source code account when coming back from Github installation', function () {
    $installationId = '45584067';
    $code = '1';
    $user = User::factory()->inPayAsYouGoMode()->create();
    $this
        ->actingAs($user)
        ->get(route('github.installation', ['installation_id' => $installationId, 'code' => $code]))
        ->assertStatus(302)
        ->assertRedirect(route('dashboard'));
})->skip('Todo: Uncomment when prod github APP is changed :(');
