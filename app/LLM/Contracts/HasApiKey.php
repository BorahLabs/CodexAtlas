<?php

namespace App\LLM\Contracts;

interface HasApiKey
{
    public function checkApiKey(string $key): bool;

    public function usingApiKey(?string $key): static;
}
