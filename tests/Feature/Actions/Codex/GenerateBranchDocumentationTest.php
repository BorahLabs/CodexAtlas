<?php

use App\Actions\Codex\Architecture\SystemComponents;
use App\Actions\Codex\GenerateBranchDocumentation;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Queue;

it('calls system component processing from a branch creation', function () {
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
    $branches = [
        $repository->branches()->create(['name' => 'master']),
        $repository->branches()->create(['name' => '7.x']),
    ];

    // should be 1 for each branch => 2
    GenerateBranchDocumentation::assertPushed(2);
    // should be 0 since the branch documentation is not executed due to fake
    SystemComponents::assertPushed(0);

    foreach ($branches as $branch) {
        GenerateBranchDocumentation::make()->handle($branch);
    }

    SystemComponents::assertPushed(2);
});
