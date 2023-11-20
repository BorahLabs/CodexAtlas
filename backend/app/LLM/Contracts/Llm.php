<?php

namespace App\LLM\Contracts;

use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm
{
    abstract public function completion(string $prompt): string;

    abstract public function embed(string ...$texts): array;

    abstract public function fileDescriptionPrompt(Project $project, File $file): string;

    public function describeFile(Project $project, File $file): string
    {
        $prompt = $this->fileDescriptionPrompt($project, $file);

        return $this->completion($prompt);
    }
}
