<?php

namespace App\LLM\Contracts;

use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm
{
    abstract public function completion(string $systemPrompt, string $userPrompt): string;

    abstract public function embed(string ...$texts): array;

    abstract public function fileDescriptionSystemPrompt(Project $project, File $file): string;

    abstract public function fileDescriptionUserPrompt(Project $project, File $file): string;

    public function describeFile(Project $project, File $file): string
    {
        $system = $this->fileDescriptionSystemPrompt($project, $file);
        $user = $this->fileDescriptionUserPrompt($project, $file);

        return $this->completion($system, $user);
    }
}
