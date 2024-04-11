<?php

namespace App\LLM;

use App\Actions\Helper\GetTotalPromptRequestTokens;
use App\LLM\Contracts\CanSupportPartialRequestInterface;
use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\DumpLlm\DumpLlmPromptRequest;
use App\LLM\PromptRequests\DumpLlm\DumpLlmPromptTechStackRequest;
use App\LLM\PromptRequests\PromptRequestType;
use App\Traits\CanSupportPartialRequest;

class DumbLocalLlm extends Llm implements CanSupportPartialRequestInterface
{
    use CanSupportPartialRequest;

    public ?PromptRequest $promptRequest = null;

    public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest
    {
        $this->promptRequest = match ($promptRequestType) {
            PromptRequestType::TECH_STACK => new DumpLlmPromptTechStackRequest(),
            default => new DumpLlmPromptRequest()
        };

        return $this->promptRequest;
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        return $this->handlePartialCompletionResponse($this->promptRequest, 'lorem ipsum');
    }

    public function makeRequest(string $prompt, string $systemPrompt, ?string $previousAnswer = null): ?CompletionResponse
    {
        return CompletionResponse::make(
            completion: $this->getCompletionResponse($systemPrompt),
            processingTimeMilliseconds: 0,
            inputTokens: 0,
            outputTokens: 0,
            totalTokens: 0,
        );
    }

    public function getMaxAmountOfTokens(): ?int
    {
        return 1;
    }


    public function getTotalPromptTokens(string $userPrompt, string $systemPrompt): int
    {
        return GetTotalPromptRequestTokens::run($userPrompt, $systemPrompt, config('services.openai.completion_model'));
    }

    public function modelName(): string
    {
        return 'dumb';
    }

    private function getCompletionResponse(string $systemPrompt)
    {
        if($systemPrompt === PromptRequestType::TECH_STACK->value) {
            return '{"worked": "true"}';
        }

        return '{"tldr":"GasStation.php is a model class that represents gas stations. It contains methods to search for gas stations, find the nearest gas stations, order gas stations by price, and get the top cheapest gas stations.","classes":[{"name":"GasStation","description":"Model class to represent gas stations","methods":[{"name":"scopeSearch","description":"Search for gas stations based on a search string"},{"name":"scopeNearest","description":"Find the nearest gas stations based on given latitude and longitude"},{"name":"scopeOrderByPrice","description":"Order gas stations by the price of gasoline 95"},{"name":"scopeTopCheapest","description":"Get the top cheapest gas stations based on the given amount"}]}]}';
    }
}
