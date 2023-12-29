<?php

use App\Actions\Gitlab\RegisterWebhook;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\GitlabProvider;
use Illuminate\Support\Facades\Storage;

it('gets all repository branches', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->gitlab()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $gitlab = (new GitlabProvider())->withCredentials($sourceCodeAccount);
    $branches = $gitlab->branches(new RepositoryName(username: 'codexatlastest1', name: 'codexatlastest'));
    expect($branches)->toBeArray();
    expect(count($branches))->toBeGreaterThan(0);
    expect($branches[0]->name)->toBe('main');
});

it('gets a single file from a repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->gitlab()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $gitlab = (new GitlabProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest1', name: 'codexatlastest');
    $file = $gitlab->file($repoName, new Branch('main'), 'README.md');

    expect($file->name)->toBe('README.md');
    expect($file->path)->toBe('README.md');
    expect($file->sha)->not->toBeEmpty();
    expect($file->downloadUrl)->not->toBeEmpty();
    expect($file->contents)->not->toBeEmpty();
});

it('gets a single repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->gitlab()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $gitlab = (new GitlabProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest1', name: 'codexatlastest');
    $repo = $gitlab->repository($repoName);

    expect($repo->name)->toBe('codexatlastest');
    expect($repo->owner)->toBe('codexatlastest1');
});

it('gets a zip file from a repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->gitlab()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $gitlab = (new GitlabProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest1', name: 'codexatlastest');
    $disk = Storage::disk('tmp');
    $zipPath = $gitlab->archive($repoName, new Branch('main'), $disk, 'gitlab.zip');
    expect($zipPath)->toBe('gitlab.zip');
    expect($disk->exists($zipPath))->toBeTrue();
});

it('returns the right icon name', function () {
    $gitlab = new GitlabProvider();
    expect($gitlab->icon())->toBe('codex.icons.gitlab');
});

it('returns the right name', function () {
    $gitlab = new GitlabProvider();
    expect($gitlab->name())->toBe('Gitlab');
});

it('returns the right url for a repository', function () {
    $gitlab = new GitlabProvider();
    $repoName = new RepositoryName(username: 'codexatlastest1', name: 'codexatlastest');
    expect($gitlab->url($repoName))->toBe('https://gitlab.com/codexatlastest1/codexatlastest');
});

it('tries to register the webhook', function () {
    RegisterWebhook::mock()
        ->shouldReceive('handle')
        ->once()
        ->andReturnNull();

    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->gitlab()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $gitlab = (new GitlabProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest1', name: 'codexatlastest');
    $gitlab->registerWebhook($repoName);
});
