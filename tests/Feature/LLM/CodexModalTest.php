<?php

use App\LLM\CodexModal;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\User;
use App\SourceCode\DTO\File;

it('has the right default model', function () {
    expect((new CodexModal())->modelName())->toBe('tgi');
});

it('returns right prompts', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $file = new File(name: 'README.md', path: 'README.md', sha: '', downloadUrl: '', contents: '## Hello World');
    $promptRequest = (new CodexModal())->getPromptRequest(PromptRequestType::DOCUMENT_FILE);
    expect($promptRequest->systemPrompt($project, $file))->not->toBeEmpty();
    expect($promptRequest->userPrompt($project, $file))
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
    $response = $client->completion('You are a dumb assistant that only replies "Yes" or "No" to questions, without any punctuation or any other word.', 'Do you exist?');
    expect($response->completion)->toBeIn(['Yes', 'No']);
    expect($response->processingTimeMilliseconds)->toBeGreaterThan(0);
    expect($response->inputTokens)->toBeGreaterThan(0);
    expect($response->outputTokens)->toBeGreaterThan(0);
    expect($response->totalTokens)->toBe($response->inputTokens + $response->outputTokens);
})->skip(fn () => empty(config('services.modal.codex.describe_file_endpoint')));
