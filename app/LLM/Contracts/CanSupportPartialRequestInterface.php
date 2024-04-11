<?php

namespace App\LLM\Contracts;

use App\LLM\DTO\CompletionResponse;

interface CanSupportPartialRequestInterface
{
    public function handlePartialCompletionResponse(PromptRequest $promptRequest, string $partialPromptConst): ?CompletionResponse;

    public function getTotalPromptTokens(string $userPrompt, string $systemPrompt): int;

    public function getMaxAmountOfTokens(): ?int;

    public function makeRequest(string $prompt, string $systemPrompt, ?string $previousAnswer = null): ?CompletionResponse;
}
