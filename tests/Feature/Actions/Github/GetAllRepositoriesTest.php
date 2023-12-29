<?php

use App\Models\SourceCodeAccount;
use App\Models\User;
use App\SourceCode\GitHubProvider;

it('gets user repositories', function () {
    $user = User::factory()->inPayAsYouGoMode()->create();
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $user->currentTeam->id,
    ]);
    $github = (new GitHubProvider())->withCredentials($sourceCodeAccount);
    $repositories = $github->repositories();
    expect($repositories)
        ->toBeArray()
        ->toHaveCount(1);
    expect($repositories[0]->owner)->toBe('codexatlastest');
    expect($repositories[0]->name)->toBe('codexatlastest');
})->skip('Maybe missing some permissions on GH?');
