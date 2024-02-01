<?php

namespace App\LLM\Contracts;

use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm
{
    abstract public function completion(string $systemPrompt, string $userPrompt): CompletionResponse;

    abstract public function modelName(): string;

    abstract public function getPromptRequest(string $promptIdentifier): PromptRequest;

    public function describeFile(Project $project, File $file, string $promptRequestIdentifier): CompletionResponse
    {
        $promptRequest = $this->getPromptRequest($promptRequestIdentifier);
        $system = $promptRequest->fileDescriptionSystemPrompt($project, $file);
        $user = $promptRequest->fileDescriptionUserPrompt($project, $file);

        return $this->completion($system, $user);
    }
}
