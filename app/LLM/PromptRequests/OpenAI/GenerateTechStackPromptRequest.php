<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;

class GenerateTechStackPromptRequest implements PromptRequest
{
    public function systemPrompt(Project $project, File $file) : string
    {
        return 'You are an expert in writing tech stack files been able to determine the main frameworks used.:

        ## Tech Stack
        [General overview of the main frameworks that are used]

        # Framework name
        [Two sentences description]

        Some rules:

        - Only talk about the most important frameworks.
        - Format the output using Markdown. Feel free to add bold, italic or even tables if you need them.
        - Do not output the original file.
        - Finish the documentation by writing "END" in a new line';
    }

    public function userPrompt(Project $project, File $file): string
    {
        return 'You are writing documentation for a file in the '.$project->name.' project. These are the file dependencies of the project:
            ```
            '.$file->contents().'
            ```';
    }
}
