<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\DumpLlm\DumpLlmPromptRequest;
use App\LLM\PromptRequests\DumpLlm\DumpLlmPromptTechStackRequest;
use App\LLM\PromptRequests\PromptRequestType;

class DumbLocalLlm extends Llm
{
    public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest
    {
        return match ($promptRequestType) {
            PromptRequestType::TECH_STACK => new DumpLlmPromptTechStackRequest(),
            default => new DumpLlmPromptRequest()
        };
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        return CompletionResponse::make(
            completion: $this->getCompletionResponse($systemPrompt),
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

    private function getCompletionResponse(string $systemPrompt): string
    {
        if ($systemPrompt === PromptRequestType::TECH_STACK->value) {
            return '{"worked": "true"}';
        }

        return '{"tldr":"GasStation.php is a model class that represents gas stations. It contains methods to search for gas stations, find the nearest gas stations, order gas stations by price, and get the top cheapest gas stations.","classes":[{"name":"GasStation","description":"Model class to represent gas stations","methods":[{"name":"scopeSearch","description":"Search for gas stations based on a search string"},{"name":"scopeNearest","description":"Find the nearest gas stations based on given latitude and longitude"},{"name":"scopeOrderByPrice","description":"Order gas stations by the price of gasoline 95"},{"name":"scopeTopCheapest","description":"Get the top cheapest gas stations based on the given amount"}]}]}';
    }
}
