<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\OpenAI\DocumentFilePromptRequest;
use App\LLM\PromptRequests\OpenAI\GenerateTechStackPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use OpenAI\Client;

class LMStudio extends Llm
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
        return config('services.lmstudio.completion_model');
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        $data = [
            'model' => $this->modelName(),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
                [
                    'role' => 'user',
                    'content' => $userPrompt,
                ],
            ],
        ];

        if (str_contains($systemPrompt, 'json')) {
            $data['response_format'] = ['type' => 'json_object'];
        }
        // wrapping on a retry function to avoid the limit per minute error
        $response = $this->client()->chat()->create($data);
        $end = intval(microtime(true) * 1000);

        return CompletionResponse::make(
            completion: $response->choices[0]->message->content,
            processingTimeMilliseconds: $end - $start,
            inputTokens: $response->usage->promptTokens,
            outputTokens: $response->usage->completionTokens,
            totalTokens: $response->usage->totalTokens,
        );
    }

    private function client(): Client
    {
        return (new \OpenAI\Factory())
            ->withBaseUri(config('services.lmstudio.url'))
            ->withApiKey('')
            ->make();
    }
}
