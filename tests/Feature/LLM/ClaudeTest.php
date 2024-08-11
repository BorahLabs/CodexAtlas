<?php

use App\LLM\Claude;
use App\LLM\PromptRequests\OpenAI\GenerateTechStackPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\User;
use App\SourceCode\DTO\File;

it('has the right default model', function () {
    expect((new Claude())->modelName())->toBe(config('services.claude.completion_model'));
});

it('returns right prompts', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $file = new File(name: 'README.md', path: 'README.md', sha: '', downloadUrl: '', contents: '## Hello World');
    $promptRequest = (new Claude())->getPromptRequest(PromptRequestType::DOCUMENT_FILE);
    expect($promptRequest->systemPrompt($project, $file))->not->toBeEmpty();
    expect($promptRequest->userPrompt($project, $file))
        ->not->toBeEmpty()
        ->toContain($project->name)
        ->toContain($file->path)
        ->toContain($file->contents);
});

it('checks API keys', function () {
    expect((new Claude())->checkApiKey(config('services.claude.key')))->toBeTrue();
    expect((new Claude())->checkApiKey('wrong-key'))->toBeFalse();
});

it('generates a completion', function () {
    $client = (new Claude())->usingApiKey(config('services.claude.key'));
    $response = $client->completion('You are a dumb assistant that only replies "Yes" without any punctuation or any other word in json format', 'Do you exist?');
    expect($response->completion)->toContain('Yes');
    expect($response->processingTimeMilliseconds)->toBeGreaterThan(0);
    expect($response->inputTokens)->toBeGreaterThan(0);
    expect($response->outputTokens)->toBeGreaterThan(0);
    expect($response->totalTokens)->toBe($response->inputTokens + $response->outputTokens);
});

it('return right prompt to get tech stack request', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $file = new File(name: 'README.md', path: 'README.md', sha: '', downloadUrl: '', contents: '## Hello World');

    $promptRequest = (new Claude())->getPromptRequest(PromptRequestType::TECH_STACK);

    expect($promptRequest)->toBeInstanceOf(GenerateTechStackPromptRequest::class);
    expect($promptRequest->systemPrompt($project, $file))->not->toBeEmpty();
    expect($promptRequest->userPrompt($project, $file))
        ->not->toBeEmpty()
        ->toContain($project->name)
        ->toContain($file->contents);
});

it('Can set a specific model correctly ', function () {
    $client = new Claude();
    $client->withModel('Test GPT');
    expect($client->modelName())->toBe('Test GPT');
});
