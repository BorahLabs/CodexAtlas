<?php

namespace App\LLM;

use App\LLM\Contracts\HasApiKey;
use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;
use OpenAI\Client;

class OpenAI extends Llm implements HasApiKey
{
    private ?string $key = null;

    public function fileDescriptionSystemPrompt(Project $project, File $file, PromptRequest $promptRequest): string
    {

        return $promptRequest->fileDescriptionSystemPrompt($project, $file);
    }

    public function fileDescriptionUserPrompt(Project $project, File $file, PromptRequest $promptRequest): string
    {
        return $promptRequest->fileDescriptionUserPrompt($project, $file);
    }

    public function modelName(): string
    {
        return config('services.openai.completion_model');
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        // wrapping on a retry function to avoid the limit per minute error
        $response = retry(3, fn () => $this->client()->chat()->create([
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
            'stop' => ['-----', "\nEND"],
        ]), 61500);
        $end = intval(microtime(true) * 1000);

        return CompletionResponse::make(
            completion: $response->choices[0]->message->content,
            processingTimeMilliseconds: $end - $start,
            inputTokens: $response->usage->promptTokens,
            outputTokens: $response->usage->completionTokens,
            totalTokens: $response->usage->totalTokens,
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
