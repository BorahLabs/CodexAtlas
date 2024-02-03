<?php

use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\RepositoryName;

it('shows the documentation of tech stack', function () {
    // create repos
    $user = User::factory()->inFreeTrialMode()->create();
    $platform = $user->currentTeam->currentPlatform();
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

    $this
        ->actingAs($user)
        ->get($platform->route('docs.show-tech-stack', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertStatus(200)
        ->assertSee('Tech Stack');
});
