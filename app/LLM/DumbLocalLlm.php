<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumbLocalLlm extends Llm
{
    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        return new CompletionResponse(
            completion: '',
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
        return '';
    }

    public function fileDescriptionUserPrompt(Project $project, File $file): string
    {
        return '';
    }

    public function modelName(): string
    {
        return 'dumb';
    }
}
