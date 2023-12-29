<?php

use App\Actions\Github\RegisterWebhook;
use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\GitHubProvider;
use Illuminate\Support\Facades\Storage;

it('gets all repository branches', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $github = (new GitHubProvider())->withCredentials($sourceCodeAccount);
    $branches = $github->branches(new RepositoryName(username: 'laravel', name: 'laravel'));
    expect($branches)->toBeArray();
    expect(count($branches))->toBeGreaterThan(0);
    expect($branches[0]->name)->toBe('master');
});

it('gets a single file from a repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $github = (new GitHubProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'laravel', name: 'laravel');
    $file = $github->file($repoName, new Branch('master'), 'composer.json');

    expect($file->name)->toBe('composer.json');
    expect($file->path)->toBe('composer.json');
    expect($file->sha)->not->toBeEmpty();
    expect($file->downloadUrl)->not->toBeEmpty();
    expect($file->contents)->not->toBeEmpty();
});

it('gets a single repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $github = (new GitHubProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'laravel', name: 'laravel');
    $repo = $github->repository($repoName);

    expect($repo->name)->toBe('laravel');
    expect($repo->owner)->toBe('laravel');
});

it('gets a zip file from a repository', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $github = (new GitHubProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'laravel', name: 'laravel');
    $disk = Storage::disk('tmp');
    $zipPath = $github->archive($repoName, new Branch('master'), $disk, 'laravel.zip');
    expect($zipPath)->toBe('laravel.zip');
    expect($disk->exists($zipPath))->toBeTrue();
});

it('returns the right icon name', function () {
    $github = new GitHubProvider();
    expect($github->icon())->toBe('codex.icons.github');
});

it('returns the right name', function () {
    $github = new GitHubProvider();
    expect($github->name())->toBe('GitHub');
});

it('returns the right url for a repository', function () {
    $github = new GitHubProvider();
    $repoName = new RepositoryName(username: 'laravel', name: 'laravel');
    expect($github->url($repoName))->toBe('https://github.com/laravel/laravel');
});

it('tries to register the webhook', function () {
    RegisterWebhook::mock()
        ->shouldReceive('handle')
        ->once()
        ->andReturnNull();

    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $github = (new GitHubProvider())->withCredentials($sourceCodeAccount);
    $repoName = new RepositoryName(username: 'laravel', name: 'laravel');
    $github->registerWebhook($repoName);
});
