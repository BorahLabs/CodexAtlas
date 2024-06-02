<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;

class GenerateTechStackPromptRequest implements PromptRequest
{
    public function systemPrompt(Project $project, File $file): string
    {
        return 'You are an expert in writing tech stack files been able to determine the main frameworks/libraries used. Give me a JSON with the main frameworks/libraries that are used.
        The JSON should have a key with the name of the framework and the value should be a medium-length description of what the framework or library is.
        This is an example of a JSON:
        {
            "Framework/Library name": "Medium description of the Framework/Library"
        }

        Some rules:

        - Only talk about the most important frameworks/libraries.
        - Do not output the original file.';
    }

    public function userPrompt(Project $project, File $file): string
    {
        return 'You are writing documentation for the file '.$file->path.' in the '.$project->name.' project. These are the file dependencies of the project:
            ```
            '.$file->contents().'
            ```';
    }
}
