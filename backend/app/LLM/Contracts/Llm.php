<?php

namespace App\LLM\Contracts;

use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm {
    public abstract function completion(string $prompt): string;

    public abstract function embed(string ...$texts): array;

    public abstract function fileDescriptionPrompt(Project $project, File $file): string;

    public function describeFile(Project $project, File $file): string
    {
        $prompt = $this->fileDescriptionPrompt($project, $file);
        return $this->completion($prompt);
    }
}
