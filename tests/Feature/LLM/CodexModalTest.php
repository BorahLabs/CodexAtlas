<?php

use App\LLM\CodexModal;
use App\Models\User;
use App\SourceCode\DTO\File;

it('has the right default model', function () {
    expect((new CodexModal())->modelName())->toBe('tgi');
});

it('returns right prompts', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $file = new File(name: 'README.md', path: 'README.md', sha: '', downloadUrl: '', contents: '## Hello World');
    expect((new CodexModal())->fileDescriptionSystemPrompt($project, $file))->not->toBeEmpty();
    expect((new CodexModal())->fileDescriptionUserPrompt($project, $file))
        ->not->toBeEmpty()
        ->toContain($project->name)
        ->toContain($file->path)
        ->toContain($file->contents);
});

it('generates a completion', function () {
    $client = (new CodexModal());
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $file = new File(name: 'KnowledgeBaseClient.php', path: 'src/Client/KnowledgeBaseClient.php', sha: '', downloadUrl: 'https://raw.githubusercontent.com/BorahLabs/Knowledge-Base-Laravel/main/src/Client/KnowledgeBaseClient.php');
    $response = $client->describeFile($project, $file);
    dd($response);
    expect($response->completion)->toContain('TLDR');
    expect($response->processingTimeMilliseconds)->toBeGreaterThan(0);
    expect($response->inputTokens)->toBe(0);
    expect($response->outputTokens)->toBe(0);
    expect($response->totalTokens)->toBeGreaterThan(0);
})->skip(fn () => empty(config('services.modal.codex.describe_file_endpoint')));
