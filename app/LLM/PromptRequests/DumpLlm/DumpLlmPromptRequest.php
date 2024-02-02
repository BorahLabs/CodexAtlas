<?php

namespace App\LLM\PromptRequests\DumpLlm;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumpLlmPromptRequest implements PromptRequest {

    public function systemPrompt(Project $project, File $file) : string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function userPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }
}

