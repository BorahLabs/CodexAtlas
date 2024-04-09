<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\OpenAI\DocumentFilePromptRequest;
use App\LLM\PromptRequests\OpenAI\GenerateTechStackPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use Illuminate\Support\Facades\Http;

class CodexModal extends Llm
{

    public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest
    {
        return match ($promptRequestType) {
            PromptRequestType::DOCUMENT_FILE => new DocumentFilePromptRequest(),
            PromptRequestType::TECH_STACK => new GenerateTechStackPromptRequest(),
        };
    }

    public function modelName(): string
    {
        return 'tgi';
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        // wrapping on a retry function to avoid the limit per minute error
        $response = retry(3, fn () => Http::post(config('services.modal.codex.describe_file_endpoint'), [
            'system' => $systemPrompt,
            'user' => $userPrompt,
            'max_tokens' => 1024,
        ])->json(), 61500);
        $end = intval(microtime(true) * 1000);

        return CompletionResponse::make(
            completion: $response['text'],
            processingTimeMilliseconds: $end - $start,
            inputTokens: 0,
            outputTokens: 0,
            totalTokens: $response['num_tokens'],
        );
    }
}
