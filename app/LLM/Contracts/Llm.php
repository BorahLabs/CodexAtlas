<?php

namespace App\LLM\Contracts;

use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm
{
    abstract public function completion(string $systemPrompt, string $userPrompt, string $projectName, File $file): CompletionResponse;

    abstract public function embed(string ...$texts): array;

    abstract public function fileDescriptionSystemPrompt(Project $project, File $file): string;

    abstract public function fileDescriptionUserPrompt(Project $project, File $file): string;

    abstract public function modelName(): string;

    public function describeFile(Project $project, File $file): CompletionResponse
    {
        $system = $this->fileDescriptionSystemPrompt($project, $file);
        $user = $this->fileDescriptionUserPrompt($project, $file);

        return $this->completion($system, $user, $project->name, $file);
    }
}
