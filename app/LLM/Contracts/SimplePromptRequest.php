<?php

namespace App\LLM\Contracts;

use App\Models\Project;
use App\SourceCode\DTO\File;

interface SimplePromptRequest
{
    public function systemPrompt(array $data): string;

    public function userPrompt(array $data): string;
}
