<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\DumpLlm\DumpLlmPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumbLocalLlm extends Llm
{

    public function getPromptRequest(PromptRequestType $promptIdentifier): PromptRequest
    {
        return match($promptIdentifier) {
            default => new DumpLlmPromptRequest()
        };
    }
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

    public function modelName(): string
    {
        return 'dumb';
    }
}
