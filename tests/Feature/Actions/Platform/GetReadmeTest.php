<?php

use App\Actions\Platform\GetReadme;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\RepositoryName;

it('gets the readme of a project', function () {
    // create repos
    $user = User::factory()->inFreeTrialMode()->create();
    $project = Project::factory()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $repo = new RepositoryName(username: 'laravel', name: 'laravel');
    $repository = $project->repositories()->create([
        'source_code_account_id' => $sourceCodeAccount->id,
        'project_id' => $project->id,
        'username' => $repo->username,
        'name' => $repo->name,
        'workspace' => $repo->workspace ?? null,
    ]);

    $branch = $repository->branches()->createQuietly(['name' => 'master']);
    $readme = GetReadme::make()->handle($repository, $branch);
    expect($readme->contents())
        ->toBeString()
        ->toContain('Laravel');
});
