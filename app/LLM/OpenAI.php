<?php

namespace App\LLM;

use App\LLM\Contracts\HasApiKey;
use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\OpenAI\DocumentFilePromptRequest;
use App\LLM\PromptRequests\OpenAI\GenerateTechStackPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use Closure;
use OpenAI\Client;

class OpenAI extends Llm implements HasApiKey
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
        return $this->model ?? config('services.openai.completion_model');
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

        if (str_contains(mb_strtolower($systemPrompt), 'json')) {
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

    public function chat(array $messages, Closure $callback = null): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        $data = [
            'model' => $this->modelName(),
            'messages' => $messages,
        ];

        // wrapping on a retry function to avoid the limit per minute error
        $response = $this->client()->chat()->createStreamed($data);
        $content = null;

        foreach ($response as $chunk) {
            if ($chunk->choices[0]->delta->content) {
                $content .= $chunk->choices[0]->delta->content;
                $callback($content);
            }
        }

        $end = intval(microtime(true) * 1000);

        return CompletionResponse::make(
            completion: $content,
            processingTimeMilliseconds: $end - $start,
            inputTokens: 0,
            outputTokens: 0,
            totalTokens: 0,
        );
    }

    public function checkApiKey(string $key): bool
    {
        try {
            $this->client($key)->models()->list();
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
        return (new \OpenAI\Factory())
            ->withApiKey($key ?? $this->key ?? config('openai.api_key'))
            ->make();
    }
}
