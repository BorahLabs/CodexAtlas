<?php

use App\Actions\Codex\GenerateTechStackDocumentation;
use App\Actions\Platform\GetTechStack;
use App\Models\User;

it('gets the techStack of a project when techstack file does not exist', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $techStack = GetTechStack::make()->handle($repository, $branch);
    expect($techStack->contents())
        ->toBeString()
        ->toContain('worked');
});

it('gets the techStack of a project when techstack exist', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    GenerateTechStackDocumentation::run($repository, $branch);

    $techStack = GetTechStack::make()->handle($repository, $branch);
    expect($techStack->contents())
        ->toBeString()
        ->toContain('worked');
});

it('check when a tech stack file is generated belongs to the correct branch', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $branchDocumentation = GenerateTechStackDocumentation::run($repository, $branch);
    expect($branchDocumentation->branch->id)->toBe($branch->id);
});

