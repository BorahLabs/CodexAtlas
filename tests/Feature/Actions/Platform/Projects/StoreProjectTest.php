<?php

// $request->validate([
//     'name' => 'required|string|max:255',
// ]);

// Gate::authorize('create-project');

// $project = $this->handle($request->user()->currentTeam, $request->input('name'));
// return redirect()->route('projects.show', ['project' => $project]);

use App\Actions\Twist\SendMessageToTwistThread;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

it('cannot create a project with invalid name', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
    $this
        ->actingAs($user)
        ->postJson($platform->route('projects.store'))
        ->assertStatus(422);
    $this
        ->actingAs($user)
        ->postJson($platform->route('projects.store'), ['name' => ''])
        ->assertStatus(422);
    $this
        ->actingAs($user)
        ->postJson($platform->route('projects.store'), ['name' => str('a')->repeat(256)])
        ->assertStatus(422);
});

it('can create a project', function (User $user) {
    Queue::fake();
    $platform = $user->currentTeam->currentPlatform();
    $this
        ->actingAs($user)
        ->postJson($platform->route('projects.store', ['name' => 'Test project']))
        ->assertStatus(302)
        ->assertRedirect($platform->route('projects.show', ['project' => $user->currentTeam->projects()->first()]));

    expect($user->currentTeam->projects()->count())->toBe(1);
    expect($user->currentTeam->projects()->first()->name)->toBe('Test project');
    SendMessageToTwistThread::assertPushed();
})->with([
    fn () => User::factory()->inFreeTrialMode()->create(),
    fn () => User::factory()->inPayAsYouGoMode()->create(),
    fn () => User::factory()->inLimitedCompanyPlanMode()->create(),
    fn () => User::factory()->inUnlimitedCompanyPlanMode()->create(),
]);
