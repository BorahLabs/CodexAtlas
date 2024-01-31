<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumbLocalLlm extends Llm
{
    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        return CompletionResponse::make(
            completion: "## TLDR\nThis is a test generation without using AI.\n\nIf you're seeing this, it means it worked!",
            processingTimeMilliseconds: 0,
            inputTokens: 0,
            outputTokens: 0,
            totalTokens: 0,
        );
    }

    public function fileDescriptionSystemPrompt(Project $project, File $file, PromptRequest $promptRequest): string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function fileDescriptionUserPrompt(Project $project, File $file, PromptRequest $promptRequest): string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function modelName(): string
    {
        return 'dumb';
    }
}
