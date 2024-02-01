<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;

class GenerateTechStackPromptRequest implements PromptRequest
{
    public function fileDescriptionSystemPrompt(Project $project, File $file) : string
    {
        return 'You are an expert in writing software documentation related with tech stack from given dependencies files. Write a short description of the provided file with the following structure:

        ## TLDR
        [General overview of the main technologies/frameworks that are used (Only the main ones)]

        Some rules:

        - Format the output using Markdown. Feel free to add bold, italic or even tables if you need them
        - Do not output the original file
        - Finish the documentation by writing "END" in a new line';
    }

    public function fileDescriptionUserPrompt(Project $project, File $file): string
    {
        return 'You are writing documentation for a file in the '.$project->name.' project. The file is located at '.$file->path.'. These are the file dependencies of the project:
            ```
            '.$file->contents().'
            ```';
    }
}
