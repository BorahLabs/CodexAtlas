<?php

use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

it('can create a github repository', function (User $user) {
    Queue::fake();
    $user = User::factory()->inFreeTrialMode()->create();
    $user->currentTeam->update(['stores_code' => true]);
    $platform = $user->currentTeam->currentPlatform();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $requestData = [
        'source_code_account_id' => $sourceCodeAccount->id,
        'name' => 'laravel/laravel',
    ];

    $this
        ->actingAs($user)
        ->postJson($platform->route('repositories.store', ['project' => $project]), $requestData)
        ->assertStatus(302)
        ->assertRedirect($platform->route('projects.show', ['project' => $project]));

})->with([
    fn () => User::factory()->inFreeTrialMode()->create(),
    fn () => User::factory()->inPayAsYouGoMode()->create(),
    fn () => User::factory()->inLimitedCompanyPlanMode()->create(),
    fn () => User::factory()->inUnlimitedCompanyPlanMode()->create(),
]);

it('can create a bitbucket repository', function (User $user) {
    Queue::fake();
    $user = User::factory()->inFreeTrialMode()->create();
    $user->currentTeam->update(['stores_code' => true]);
    $platform = $user->currentTeam->currentPlatform();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);

    $requestData = [
        'source_code_account_id' => $sourceCodeAccount->id,
        'bitbucket_workspace' => 'codexatlas-test',
        'bitbucket_repo' => 'test',
    ];

    $this
        ->actingAs($user)
        ->postJson($platform->route('repositories.store', ['project' => $project]), $requestData)
        ->assertStatus(302)
        ->assertRedirect($platform->route('projects.show', ['project' => $project]));

})->with([
    fn () => User::factory()->inFreeTrialMode()->create(),
    fn () => User::factory()->inPayAsYouGoMode()->create(),
    fn () => User::factory()->inLimitedCompanyPlanMode()->create(),
    fn () => User::factory()->inUnlimitedCompanyPlanMode()->create(),
]);
