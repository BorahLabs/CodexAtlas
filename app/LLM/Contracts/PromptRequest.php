<?php

namespace App\LLM\Contracts;

use App\Models\Project;
use App\SourceCode\DTO\File;

interface PromptRequest
{
    public function fileDescriptionSystemPrompt(Project $project, File $file): string;

    public function fileDescriptionUserPrompt(Project $project, File $file): string;
}
