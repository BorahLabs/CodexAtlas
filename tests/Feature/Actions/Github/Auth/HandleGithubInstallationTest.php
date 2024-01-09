<?php

use App\Models\Project;
use App\Models\User;

it('does not creates the source code account when using an invalid installation id', function () {
    $installationId = '1';
    $user = User::factory()->inPayAsYouGoMode()->create();
    $this
        ->actingAs($user)
        ->get(route('github.installation', ['installation_id' => $installationId]))
        ->assertInternalServerError();
});

it('creates the source code account when coming back from Github installation', function () {
    $installationId = '45584067';
    $user = User::factory()->inPayAsYouGoMode()->create();
    $this
        ->actingAs($user)
        ->get(route('github.installation', ['installation_id' => $installationId]))
        ->assertStatus(302)
        ->assertRedirect(route('dashboard'));
});
