<?php

namespace App\LLM\PromptRequests\DumpLlm;

use App\LLM\Contracts\PromptRequest;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DumpLlmPromptTechStackRequest implements PromptRequest
{
    public function systemPrompt(Project $project, File $file): string
    {
        return PromptRequestType::TECH_STACK->value;
    }

    public function userPrompt(Project $project, File $file): string
    {
        return 'Lorem ipsum dolor sit amet';
    }
}
