<?php

use App\Models\CustomGuide;
use App\Models\User;

it('cannot see the guide page if not logged in', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $this
        ->get($platform->route('docs.guides.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertStatus(302)
        ->assertRedirect($platform->route('login'));
});

it('can see the guide page if is public', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $platform->update(['is_public' => true]);

    $this
        ->get($platform->route('docs.guides.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertSuccessful();
});

it('can see the guide page if user belongs to the right team', function () {
    $user1 = User::factory()->inFreeTrialMode()->create();
    $user2 = User::factory()->inFreeTrialMode()->create();
    $platform = $user1->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user1->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();

    $this
        ->actingAs($user1)
        ->get($platform->route('docs.guides.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertSuccessful();

    $this
        ->actingAs($user2)
        ->get($platform->route('docs.guides.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertForbidden();
});

it('renders the title and content', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $this
        ->actingAs($user)
        ->get($platform->route('docs.guides.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertSuccessful()
        ->assertSee($customGuide->title)
        ->assertSee($customGuide->content)
        ->assertSee('Edit guide')
        ->assertSee('Delete guide');
});

it('does not show edit and delete buttons in public pages', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $platform->update(['is_public' => true]);

    $this
        ->get($platform->route('docs.guides.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertSuccessful()
        ->assertDontSee('Edit guide')
        ->assertDontSee('Delete guide');
});
