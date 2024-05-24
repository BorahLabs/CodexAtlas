<?php

namespace App\LLM\Contracts;

interface SimplePromptRequest
{
    public function systemPrompt(array $data): string;

    public function userPrompt(array $data): string;
}
