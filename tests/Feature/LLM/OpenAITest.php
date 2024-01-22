<?php

use App\LLM\OpenAI;
use App\Models\User;
use App\SourceCode\DTO\File;

it('has the right default model', function () {
    expect((new OpenAI())->modelName())->toBe(config('services.openai.completion_model'));
});

it('returns right prompts', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $file = new File(name: 'README.md', path: 'README.md', sha: '', downloadUrl: '', contents: '## Hello World');
    expect((new OpenAI())->fileDescriptionSystemPrompt($project, $file))->not->toBeEmpty();
    expect((new OpenAI())->fileDescriptionUserPrompt($project, $file))
        ->not->toBeEmpty()
        ->toContain($project->name)
        ->toContain($file->path)
        ->toContain($file->contents);
});

it('checks API keys', function () {
    expect((new OpenAI())->checkApiKey(config('services.openai.key')))->toBeTrue();
    expect((new OpenAI())->checkApiKey('wrong-key'))->toBeFalse();
});

it('generates a completion', function () {
    $client = (new OpenAI())->usingApiKey(config('services.openai.key'));
    $response = $client->completion('You are a dumb assistant that only replies "Yes" or "No" to questions, without any punctuation or any other word.', 'Do you exist?');
    expect($response->completion)->toBeIn(['Yes', 'No']);
    expect($response->processingTimeMilliseconds)->toBeGreaterThan(0);
    expect($response->inputTokens)->toBeGreaterThan(0);
    expect($response->outputTokens)->toBeGreaterThan(0);
    expect($response->totalTokens)->toBe($response->inputTokens + $response->outputTokens);
});
