<?php

use App\Actions\Codex\GenerateBranchDocumentation;
use App\Actions\Codex\GenerateProjectDocumentation;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Queue;

it('calls branch documentation generation for a project', function () {
    Queue::fake();

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
    $repository->branches()->createQuietly(['name' => 'master']);
    $repository->branches()->createQuietly(['name' => '7.x']);
    $repository->branches()->createQuietly(['name' => '8.x']);

    $repo = new RepositoryName(username: 'livewire', name: 'livewire');
    $repository = $project->repositories()->create([
        'source_code_account_id' => $sourceCodeAccount->id,
        'project_id' => $project->id,
        'username' => $repo->username,
        'name' => $repo->name,
        'workspace' => $repo->workspace ?? null,
    ]);
    $repository->branches()->createQuietly(['name' => 'main']);

    // Generate docs
    GenerateProjectDocumentation::make()->handle($project->fresh());

    // should be 1 for each branch => 4
    GenerateBranchDocumentation::assertPushed(4);
});
