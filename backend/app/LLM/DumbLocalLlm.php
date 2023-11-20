<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;

class DumbLocalLlm implements Llm
{
    public function completion(): string
    {
        return '';
    }

    public function embed(): array
    {
        return [];
    }
}
