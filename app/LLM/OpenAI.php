<?php

namespace App\LLM;

use App\Actions\Helper\GetTotalPromptRequestTokens;
use App\LLM\Contracts\CanSupportPartialRequestInterface;
use App\LLM\Contracts\HasApiKey;
use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\OpenAI\DocumentFilePromptRequest;
use App\LLM\PromptRequests\OpenAI\GenerateTechStackPromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use App\Traits\CanSupportPartialRequest;
use OpenAI\Client;

class OpenAI extends Llm implements HasApiKey, CanSupportPartialRequestInterface
{
    use CanSupportPartialRequest;

    private ?string $key = null;

    private ?string $model = null;

    public ?PromptRequest $promptRequest = null;

    public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest
    {
        $this->promptRequest = match ($promptRequestType) {
            PromptRequestType::DOCUMENT_FILE => new DocumentFilePromptRequest(),
            PromptRequestType::TECH_STACK => new GenerateTechStackPromptRequest(),
        };

        return $this->promptRequest;
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

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        if(app()->environment('testing')) {
            return $this->makeRequest($userPrompt, $systemPrompt);
        }

        // @codeCoverageIgnoreStart
        $const = $this->getConstPrompt();

        $completionResponse = $this->handlePartialCompletionResponse($this->promptRequest, $const);

        if($completionResponse) {
            return $completionResponse;
        }

        return $this->makeRequest($userPrompt, $systemPrompt);

        // @codeCoverageIgnoreEnd
    }

    public function makeRequest(string $prompt, string $systemPrompt, ?string $previousAnswer = null): ?CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        if($previousAnswer) {
            // @codeCoverageIgnoreStart
            $prompt .= 'An this was the previous answer: '.$previousAnswer;
            // @codeCoverageIgnoreEnd
        }
        $response = retry(3, fn () => $this->client()->chat()->create([
            'model' => $this->modelName(),
            'response_format' => [ "type" => "json_object" ],
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
                [
                    'role' => 'user',
                    'content' => $prompt,
                ],
            ],
            'stop' => ['-----', "\nEND"],
        ]), 61500);
        $end = intval(microtime(true) * 1000);
        $previousAnswer = $response->choices[0]->message->content;
        return CompletionResponse::make(
            completion: $response->choices[0]->message->content,
            processingTimeMilliseconds: $end - $start,
            inputTokens: $response->usage->promptTokens,
            outputTokens: $response->usage->completionTokens,
            totalTokens: $response->usage->totalTokens,
        );
    }

    // @codeCoverageIgnoreStart
    public function getTotalPromptTokens(string $userPrompt, string $systemPrompt): int
    {
        return GetTotalPromptRequestTokens::run($userPrompt, $systemPrompt, $this->modelName());
    }

    public function getMaxAmountOfTokens(): ?int
    {
        $tokens = config('services.openai.tokens');
        return isset($tokens[$this->modelName()])? $tokens[$this->modelName()] : null;
    }

    private function getConstPrompt(): ?string
    {
        return match(true) {
            $this->promptRequest instanceof GenerateTechStackPromptRequest => 'You are writing documentation for a file in a project with this name: '. $this->promptRequest->project?->name. '. These are the file dependencies of the project: ',
            $this->promptRequest instanceof DocumentFilePromptRequest => 'You are writing documentation for a file in a project with this name: '. $this->promptRequest->project?->name. '. These is the content of the file: '
        };
    }
    // @codeCoverageIgnoreEnd

}
