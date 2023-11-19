<?php

namespace App\LLM\Contracts;

interface Llm {
    public function completion(): string;

    public function embed(): array;
}
