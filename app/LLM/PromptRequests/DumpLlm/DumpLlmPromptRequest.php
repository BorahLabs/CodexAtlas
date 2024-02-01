<?php

namespace App\LLM\PromptRequests\DumpLlm;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumpLlmPromptRequest implements PromptRequest {

    public function fileDescriptionSystemPrompt(Project $project, File $file) : string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function fileDescriptionUserPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }
}

