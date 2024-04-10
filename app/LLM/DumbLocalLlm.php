<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\DumpLlm\DumpLlmPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;

class DumbLocalLlm extends Llm
{
    public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest
    {
        return match ($promptRequestType) {
            default => new DumpLlmPromptRequest()
        };
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        return CompletionResponse::make(
            completion: '{"worked" : true}',
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
