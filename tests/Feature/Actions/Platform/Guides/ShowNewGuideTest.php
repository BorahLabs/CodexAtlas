<?php

use App\Livewire\Alexandria\PageSetup;
use App\Models\User;
use Livewire\Livewire;

it('cannot see the new guide page if not logged in', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $this
        ->get($platform->route('docs.guides.new', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertStatus(302)
        ->assertRedirect($platform->route('login'));

    $platform->update(['is_public' => true]);

    $this
        ->get($platform->route('docs.guides.new', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertForbidden();
})->skip();

it('can see the new guide page if user belongs to the right team', function () {
    $user1 = User::factory()->inFreeTrialMode()->create();
    $user2 = User::factory()->inFreeTrialMode()->create();
    $platform = $user1->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user1->currentTeam);
    $this
        ->actingAs($user1)
        ->get($platform->route('docs.guides.new', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertSuccessful();
    $this
        ->actingAs($user2)
        ->get($platform->route('docs.guides.new', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertForbidden();
})->skip();

it('renders the right livewire component', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    $this
        ->actingAs($user)
        ->get($platform->route('docs.guides.new', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertSeeLivewire(PageSetup::class);
})->skip();

it('can create a new guide page', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    $this->assertEquals(0, $branch->customGuides()->count());

    Livewire::actingAs($user)
        ->test(PageSetup::class, [
            'branch' => $branch,
        ])
        ->set('title', 'My new guide')
        ->set('content', 'This is the content of my new guide')
        ->call('submit');

    $this->assertEquals(1, $branch->customGuides()->count());
})->skip();

it('can create a new guide page by using a question', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    $this->assertEquals(0, $branch->customGuides()->count());

    Livewire::actingAs($user)
        ->test(PageSetup::class, [
            'branch' => $branch,
        ])
        ->set('question', 'this is a question')
        ->call('submitQuestion')
        ->assertSet('title', '# TLDR')
        ->assertSet('content', "This is a test generation without using AI.\n\nIf you're seeing this, it means it worked!")
        ->call('submit');

    $this->assertEquals(1, $branch->customGuides()->count());
})->skip();

it('validates the question and the title', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    Livewire::actingAs($user)
        ->test(PageSetup::class, [
            'branch' => $branch,
        ])
        ->set('question', str('a')->repeat(512))
        ->call('submitQuestion')
        ->assertHasNoErrors('question')
        ->set('question', str('a')->repeat(513))
        ->call('submitQuestion')
        ->assertHasErrors('question');

    Livewire::actingAs($user)
        ->test(PageSetup::class, [
            'branch' => $branch,
        ])
        ->set('title', str('a')->repeat(512))
        ->call('submit')
        ->assertHasNoErrors('title')
        ->assertHasErrors('content')
        ->set('title', str('a')->repeat(513))
        ->call('submit')
        ->assertHasErrors('title')
        ->assertHasErrors('content')
        ->set('title', 'A title')
        ->set('content', 'A content')
        ->call('submit')
        ->assertHasNoErrors('title')
        ->assertHasNoErrors('content');
})->skip();
