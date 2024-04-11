<?php

namespace App\LLM\PromptRequests\DumpLlm;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;
use App\Traits\HasFileDTO;
use App\Traits\HasProject;

class DumpLlmPromptRequest implements PromptRequest
{
    use HasProject, HasFileDTO;

    public function systemPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }

    public function userPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }
}
