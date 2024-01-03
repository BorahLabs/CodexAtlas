<?php

use App\Actions\Platform\Repositories\StoreRepository;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;

it('runs the whole process of documenting with GitHub', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $user->currentTeam->update(['stores_code' => true]);
    $platform = $user->currentTeam->currentPlatform();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    StoreRepository::make()->handle($project, $sourceCodeAccount->id, 'laravel/laravel');

    $branch = $project->repositories()->first()->branches()->first();

    expect($branch->systemComponents()->count())->toBe(5);
    $branch->systemComponents()->each(function ($component) {
        expect($component->markdown_docs)->not->toBeEmpty();
        expect($component->file_contents)->not->toBeEmpty();
    });
});

it('runs the whole process of documenting with Gitlab', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    $user->currentTeam->update(['stores_code' => false]);
    $platform = $user->currentTeam->currentPlatform();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $sourceCodeAccount = SourceCodeAccount::factory()->gitlab()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    StoreRepository::make()->handle($project, $sourceCodeAccount->id, 'codexatlastest1/codexatlastest');

    $branch = $project->repositories()->first()->branches()->first();

    expect($branch->systemComponents()->count())->toBe(1);
    $branch->systemComponents()->each(function ($component) {
        expect($component->markdown_docs)->not->toBeEmpty();
        expect($component->file_contents)->toBeEmpty();
    });
});
