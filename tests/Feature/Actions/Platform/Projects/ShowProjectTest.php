<?php

use App\Models\Project;
use App\Models\User;

it('can see a project', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $platform = $user->currentTeam->currentPlatform();

    $this
        ->actingAs($user)
        ->get($platform->route('projects.show', ['project' => $project]))
        ->assertStatus(200);
});

it('cannot see a project from a different team', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $user2 = User::factory()->inFreeTrialMode()->create();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $platform = $user->currentTeam->currentPlatform();

    $this
        ->actingAs($user2)
        ->get($platform->route('projects.show', ['project' => $project]))
        ->assertStatus(302);
});
