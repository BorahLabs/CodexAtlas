<?php

use App\Actions\Bitbucket\RegisterWebhook;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\BitbucketProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Support\Facades\Storage;

it('gets all repository branches', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $branches = $bitbucket->branches(new RepositoryName(username: 'codexatlastest', name: 'test', workspace: 'codexatlas-test'));
    expect($branches)->toBeArray();
    expect(count($branches))->toBeGreaterThan(0);
    expect($branches[0]->name)->toBe('main');
});

it('gets a single file from a repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest', name: 'test', workspace: 'codexatlas-test');
    $file = $bitbucket->file($repoName, new Branch('main'), 'README.md');

    expect($file->name)->toBe('README.md');
    expect($file->path)->toBe('README.md');
    expect($file->sha)->not->toBeEmpty();
    expect($file->downloadUrl)->not->toBeEmpty();
    expect($file->contents)->not->toBeEmpty();
});

it('gets a single repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest', name: 'test', workspace: 'codexatlas-test');
    $repo = $bitbucket->repository($repoName);

    expect($repo->name)->toBe('test');
    expect($repo->owner)->toBe('codexatlas-test');
});

it('gets a zip file from a repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest', name: 'test', workspace: 'codexatlas-test');
    $disk = Storage::disk('tmp');
    $zipPath = $bitbucket->archive($repoName, new Branch('main'), $disk, 'test.zip');
    expect($zipPath)->toBe('test.zip');
    expect($disk->exists($zipPath))->toBeTrue();
});

it('returns the right icon name', function () {
    $bitbucket = new BitbucketProvider();
    expect($bitbucket->icon())->toBe('codex.icons.bitbucket');
});

it('returns the right name', function () {
    $bitbucket = new BitbucketProvider();
    expect($bitbucket->name())->toBe('Bitbucket');
});

it('returns the right url for a repository', function () {
    $bitbucket = new BitbucketProvider();
    $repoName = new RepositoryName(username: 'codexatlastest', name: 'test', workspace: 'codexatlas-test');
    expect($bitbucket->url($repoName))->toBe('https://bitbucket.com/codexatlas-test/test');
});

it('tries to register the webhook', function () {
    RegisterWebhook::mock()
        ->shouldReceive('handle')
        ->once()
        ->andReturnNull();

    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'codexatlastest', name: 'test', workspace: 'codexatlas-test');
    $bitbucket->registerWebhook($repoName);
});

it('gets the user account', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $account = $bitbucket->account();
    expect($account->name)->toBe($sourceCodeAccount->name);
    expect($account->id)->toBe($sourceCodeAccount->external_id);
});

it('gets all the repositories', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->bitbucket()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $bitbucket = (new BitbucketProvider())->withCredentials($sourceCodeAccount);
    $repositories = $bitbucket->repositories();
    expect($repositories)->toBeArray();
    expect(count($repositories))->toBeGreaterThan(0);
    expect($repositories[0]->id)->not->toBeEmpty();
    expect($repositories[0]->name)->toBe('test');
    expect($repositories[0]->owner)->toBe('codexatlas-test');
    expect($repositories[0]->workspace)->toBe('codexatlas-test');
});
