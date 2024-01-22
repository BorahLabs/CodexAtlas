<?php

use App\Livewire\Alexandria\PageSetup;
use App\Models\CustomGuide;
use App\Models\User;
use Livewire\Livewire;

it('cannot see the edit guide page if not logged in', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $this
        ->get($platform->route('docs.guides.edit', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertStatus(302) // is 302 because of the applied middleware before the action
        ->assertRedirect($platform->route('login'));

    $platform->update(['is_public' => true]);

    $this
        ->get($platform->route('docs.guides.edit', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertForbidden();
});

it('cannot access to edit a guide page if user belongs to a different team', function () {
    $user1 = User::factory()->inFreeTrialMode()->create();
    $user2 = User::factory()->inFreeTrialMode()->create();
    $platform = $user1->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user1->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();

    $this
        ->actingAs($user2)
        ->get($platform->route('docs.guides.edit', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertForbidden();
});

it('can access to edit a guide page', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();

    $this
        ->actingAs($user)
        ->get($platform->route('docs.guides.edit', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]))
        ->assertSuccessful()
        ->assertSeeLivewire(PageSetup::class);
});

it('can edit a guide page', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $customGuide = CustomGuide::factory()->for($branch)->create();
    $this->assertEquals(1, $branch->customGuides()->count());

    Livewire::actingAs($user)
        ->test(PageSetup::class, [
            'branch' => $branch,
            'customGuide' => $customGuide,
        ])
        ->set('title', 'My new guide')
        ->set('content', 'This is the content of my new guide')
        ->set('question', 'What is the answer to life, the universe and everything?')
        ->call('submit');

    $customGuide->refresh();
    $this->assertEquals(1, $branch->customGuides()->count());
    $this->assertEquals('My new guide', $customGuide->title);
    $this->assertEquals('This is the content of my new guide', $customGuide->content);
    $this->assertEquals('What is the answer to life, the universe and everything?', $customGuide->question);
});
