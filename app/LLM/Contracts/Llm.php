<?php

namespace App\LLM\Contracts;

use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm
{
    abstract public function completion(string $systemPrompt, string $userPrompt): CompletionResponse;

    abstract public function fileDescriptionSystemPrompt(Project $project, File $file, PromptRequest $promptRequest): string;

    abstract public function fileDescriptionUserPrompt(Project $project, File $file, PromptRequest $promptRequest): string;

    abstract public function modelName(): string;

    public function describeFile(Project $project, File $file, PromptRequest $promptRequest): CompletionResponse
    {
        $system = $this->fileDescriptionSystemPrompt($project, $file, $promptRequest);
        $user = $this->fileDescriptionUserPrompt($project, $file, $promptRequest);

        return $this->completion($system, $user);
    }
}
