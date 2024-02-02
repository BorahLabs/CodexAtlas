<?php

namespace App\LLM\Contracts;

use App\Models\Project;
use App\SourceCode\DTO\File;

interface PromptRequest
{
    public function systemPrompt(Project $project, File $file): string;

    public function userPrompt(Project $project, File $file): string;
}
