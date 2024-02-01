<?php

use App\Actions\Platform\GetTechStack;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\User;

it('gets the techStack of a project', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $techStack = GetTechStack::make()->handle($repository, $branch);
    expect($techStack->contents())
        ->toBeString()
        ->toContain('worked');
});

