<?php

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Models\ProcessingLogEntry;
use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\RepositoryName;

it('successfully processes a file', function () {
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
    $file = new File(
        name: 'composer.json',
        path: 'composer.json',
        sha: '123',
        downloadUrl: '',
    );

    expect($branch->systemComponents()->count())->toBe(0);
    expect(ProcessingLogEntry::count())->toBe(0);
    ProcessSystemComponent::make()->handle($branch, $file, 0);

    expect($branch->systemComponents()->count())->toBe(1);
    expect($branch->systemComponents()->first()->path)->toBe('composer.json');
    expect($branch->systemComponents()->first()->markdown_docs)->not->toBeEmpty();
    expect(ProcessingLogEntry::count())->toBe(1);
});
