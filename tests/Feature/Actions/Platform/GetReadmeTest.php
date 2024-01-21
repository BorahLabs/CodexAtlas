<?php

use App\Actions\Platform\GetReadme;
use App\Models\User;

it('gets the readme of a project', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $readme = GetReadme::make()->handle($repository, $branch);
    expect($readme->contents())
        ->toBeString()
        ->toContain('Laravel');
});

it('upserts the branch document', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    expect($branch->branchDocuments()->count())->toBe(0);
    $readme = GetReadme::make()->handle($repository, $branch);
    expect($branch->branchDocuments()->count())->toBe(1);
    expect($branch->branchDocuments()->first()->name)->toBe('README.md');

    GetReadme::make()->handle($repository, $branch);
    expect($branch->branchDocuments()->count())->toBe(1);
});
