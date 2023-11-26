<?php

namespace App\LLM\DTO;

class CompletionResponse
{
    public function __construct(
        public readonly string $completion,
        public readonly int $processingTimeMilliseconds,
        public readonly int $inputTokens,
        public readonly int $outputTokens,
        public readonly int $totalTokens,
    ) {
        //
    }

    public static function make(string $completion, int $processingTimeMilliseconds, int $inputTokens, int $outputTokens, int $totalTokens): static
    {
        return new static($completion, $processingTimeMilliseconds, $inputTokens, $outputTokens, $totalTokens);
    }
}
