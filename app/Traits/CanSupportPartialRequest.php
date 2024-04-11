<?php

namespace App\Traits;

use App\LLM\Contracts\PromptRequest;
use App\LLM\DTO\CompletionResponse;

trait CanSupportPartialRequest {

    public function handlePartialCompletionResponse(PromptRequest $promptRequest, string $partialPromptConst): ?CompletionResponse
    {
        $systemPrompt = $promptRequest->systemPrompt($promptRequest->project(), $promptRequest->file());
        $userPrompt = $promptRequest->userPrompt($promptRequest->project(), $promptRequest->file());

        $totalTokens = $this->getTotalPromptTokens($userPrompt, $systemPrompt);
        $maxAmountOfTokens = $this->getMaxAmountOfTokens();

        if($totalTokens < $maxAmountOfTokens || $maxAmountOfTokens === null) {
            // @codeCoverageIgnoreStart
            return null;
            // @codeCoverageIgnoreEnd
        }

        $subPromptsCount = ceil($totalTokens / $maxAmountOfTokens);
        $subPrompts = $this->generateSubPrompts($subPromptsCount, $partialPromptConst);
        return $this->handlePromptRequest($subPrompts, $systemPrompt);
    }


    private function generateSubPrompts(int $subPromptsCount, string $subPromptConst): array
    {
        $subPromts = [];

        $lines = explode("\n", $this->promptRequest->file->contents());
        $partSize = ceil(count($lines) / $subPromptsCount);
        $dividedLines = array_chunk($lines, $partSize);
        foreach($dividedLines as $line) {
            $subPromts[] = $subPromptConst."\n".implode("\n", $line);
        }
        return $subPromts;
    }


    private function handlePromptRequest(array $subPromts, string $systemPrompt): ?CompletionResponse
    {
        $responses = [];
        $previousAnswer = null;

        foreach($subPromts as $prompt) {
            $completionResponse = $this->makeRequest($prompt, $systemPrompt, $previousAnswer);
            $responses[] = $completionResponse;
            $previousAnswer = $completionResponse->completion;
        }
        $completionResponse = $this->mergeCompletionResponses($responses);
        return $completionResponse;
    }

    private function mergeCompletionResponses(array $responses) {

        $completion = [];
        $processingTimeMilliseconds = 0;
        $inputTokens = 0;
        $outputTokens = 0;
        $totalTokens = 0;


        foreach ($responses as $response) {
            $jsonData = json_decode($response->completion, true);
            $completion = $this->mergeJsons($jsonData, $completion);
            $processingTimeMilliseconds += $response->processingTimeMilliseconds;
            $inputTokens += $response->inputTokens;
            $outputTokens += $response->outputTokens;
            $totalTokens += $response->totalTokens;
        }

        return new CompletionResponse(json_encode($completion), $processingTimeMilliseconds, $inputTokens, $outputTokens, $totalTokens);
    }

    private function mergeJsons(array $newJson, array $completion)
    {

        foreach ($newJson as $key => $value) {
            if (is_array($value) && array_key_exists($key, $completion) && is_array($completion[$key])) {
                $completion[$key] = $this->mergeJsons($value, $completion[$key]);
            } else {
                $completion[$key] = $value;
            }
        }
        return $completion;
    }
}
