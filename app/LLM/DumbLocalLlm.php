<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumbLocalLlm extends Llm
{
    public function completion(string $systemPrompt, string $userPrompt, string $projectName, File $file): CompletionResponse
    {
        return new CompletionResponse(
            completion: ["## TLDR\nThis is a test generation without using AI.\n\nIf you're seeing this, it means it worked!"],
            processingTimeMilliseconds: 0,
            inputTokens: 0,
            outputTokens: 0,
            totalTokens: 0,
        );
    }

    public function embed(string ...$texts): array
    {
        return [];
    }

    public function fileDescriptionSystemPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function fileDescriptionUserPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function modelName(): string
    {
        return 'dumb';
    }
}
