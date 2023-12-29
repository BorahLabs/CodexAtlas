<?php

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\RepositoryName;

it('redirects the user to the README page', function () {
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
        ->get($platform->route('docs.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch]))
        ->assertStatus(302)
        ->assertRedirect($platform->route('docs.show-readme', ['project' => $project, 'repository' => $repository, 'branch' => $branch]));
});

it('shows the documentation of a system component', function () {
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
    $file = new File(
        name: 'composer.json',
        path: 'composer.json',
        sha: '123',
        downloadUrl: '',
    );

    ProcessSystemComponent::make()->handle($branch, $file, 0);
    $systemComponent = $branch->systemComponents()->first();

    $this
        ->actingAs($user)
        ->get($platform->route('docs.show-component', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'systemComponent' => $systemComponent]))
        ->assertStatus(200);
});
