<?php

namespace App\LLM;

use App\LLM\Contracts\HasApiKey;
use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\OpenAI\DocumentFilePromptRequest;
use App\LLM\PromptRequests\OpenAI\GenerateTechStackPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use Claude\Claude3Api\Client;
use Claude\Claude3Api\Config;

class Claude extends Llm implements HasApiKey
{
    private ?string $key = null;

    private ?string $model = null;

    public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest
    {
        return match ($promptRequestType) {
            PromptRequestType::DOCUMENT_FILE => new DocumentFilePromptRequest(),
            PromptRequestType::TECH_STACK => new GenerateTechStackPromptRequest(),
        };
    }

    public function withModel(string $model): static
    {
        $this->model = $model;

        return $this;
    }

    public function modelName(): string
    {
        return $this->model ?? config('services.claude.completion_model');
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        $data = [
            'model' => $this->modelName(),
            'system' => $systemPrompt,
            'messages' => [
                [
                    'role' => 'user',
                    'content' => $userPrompt,
                ],
            ],
        ];

        // wrapping on a retry function to avoid the limit per minute error
        $response = $this->client()->chat($data);
        $end = intval(microtime(true) * 1000);

        $usage = $response->getUsage();
        return CompletionResponse::make(
            completion: $response->getContent()[0]['text'],
            processingTimeMilliseconds: $end - $start,
            inputTokens: $usage['input_tokens'],
            outputTokens: $usage['output_tokens'],
            totalTokens: $usage['input_tokens'] + $usage['output_tokens'],
        );
    }

    public function checkApiKey(string $key): bool
    {
        try {
            $this->client($key)->chat([
                'model' => $this->modelName(),
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => 'Hello!',
                    ],
                ],
                'maxTokens' => 1,
            ]);
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function usingApiKey(?string $key): static
    {
        $this->key = $key;

        return $this;
    }

    private function client(?string $key = null): Client
    {
        $config = new Config($key ?? $this->key ?? config('services.claude.key'));
        $client = new Client($config);
        return $client;
    }
}
