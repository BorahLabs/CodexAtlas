<?php

namespace App\Actions\Helper;

use Lorisleiva\Actions\Concerns\AsAction;

class GetTotalPromptRequestTokens
{
    use AsAction;

    public function handle(string $userPrompt, string $systemPrompt, string $model): int
    {
        $userPromptTokens = GetPromptTokens::run($model, $userPrompt);
        $systemPromptTokens = GetPromptTokens::run($model, $systemPrompt);
        return $userPromptTokens + $systemPromptTokens;
    }
}
