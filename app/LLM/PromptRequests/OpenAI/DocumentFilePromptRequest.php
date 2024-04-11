<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\PromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;

class DocumentFilePromptRequest implements PromptRequest
{
    public function systemPrompt(Project $project, File $file): string
    {
        return 'You are an expert in writing software documentation. Write a short description of the provided in JSON format with the following structure:

        [KEY] tldr
        [VALUE] General overview of what the file does

        [KEY] classes
        [VALUE] A JSON with this structure:

            "name": "Name of the class",
            "description": "Small Description of the class",
            "methods": [
                {
                    "name": "Name of the method",
                    "description": "What the method does"
                }
            ]

        Some rules:
        - Response JSON Always should have key tldr.
        - Response JSON Always should have key classes,
        - Classes value should be an array where each item have the keys name, description and methods.
        - methods value should be an array where each item should have key name and description. If you dont find any method you can return an empty array.
        - [KEY] Means the key of the json and the [VALUE] means the value that should be in this key.
        - Do not output the original file
        - If there are no methods or no classes, please do not include the section in the output
        - Dont add \n, Only the json is required';
    }

    public function userPrompt(Project $project, File $file): string
    {
        return 'You are writing documentation for a file in the '.$project->name.' project. The file is located at '.$file->path.'. These are the file contents:
            ```'.$file->extension().'
            '.$file->contents().'
            ```';
    }
}
