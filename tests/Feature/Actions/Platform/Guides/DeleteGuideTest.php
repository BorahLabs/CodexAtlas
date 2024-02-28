<?php

use App\Models\CustomGuide;
use App\Models\User;

it('cannot delete a guide page if not logged in', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $this
        ->post($platform->route('docs.guides.destroy', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertStatus(302) // is 302 because of the applied middleware before the action
        ->assertRedirect($platform->route('login'));

    $platform->update(['is_public' => true]);
    $this
        ->post($platform->route('docs.guides.destroy', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertForbidden();
})->skip();

it('cannot delete a guide if user belongs to a different team', function () {
    $user1 = User::factory()->inFreeTrialMode()->create();
    $user2 = User::factory()->inFreeTrialMode()->create();
    $platform = $user1->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user1->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();

    $this
        ->actingAs($user2)
        ->post($platform->route('docs.guides.destroy', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertForbidden();
})->skip();

it('can delete a guide', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();

    $this
        ->actingAs($user)
        ->post($platform->route('docs.guides.destroy', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertRedirect($platform->route('docs.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch]));

    expect(CustomGuide::find($customGuide->id))->toBeNull();
})->skip();
