<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;
use App\Traits\HasFileDTO;
use App\Traits\HasProject;

class GenerateTechStackPromptRequest implements PromptRequest
{
    use HasProject, HasFileDTO;

    public const INTRODUCE_PROJET_NAME = 'You are writing documentation for a file in a project with this name: ';
    public const INTRODUCE_PROJECT_DEPENDENCIES = '. These are the file dependencies of the project: ';

    public function systemPrompt(Project $project, File $file): string
    {
        return 'You are an expert in writing tech stack files been able to determine the main frameworks used. Give me a JSON with the main frameworks that are used.
        The JSON should have a key with the name of the framework and the value should be medium description.
        This is an example of the json {"Framework name" : "Medium description of the Framework" }
        Sometimes you may receive previous json generated. In that case, do the merge of the new json with the old one.
        The keys of the json shoul be a human format. Try to avoid things like laravel/framework and put the key as Laravel insetad.

        Some rules:

        - Only talk about the most important frameworks.
        - Do not output the original file.';
    }

    public function userPrompt(Project $project, File $file): string
    {
        return self::INTRODUCE_PROJET_NAME.$project->name.self::INTRODUCE_PROJECT_DEPENDENCIES.'
            ```
            '.$file->contents().'
            ```';
    }
}
