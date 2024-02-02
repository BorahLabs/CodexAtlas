<?php

namespace App\LLM\Contracts;

use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Project;
use App\SourceCode\DTO\File;

abstract class Llm
{
    abstract public function completion(string $systemPrompt, string $userPrompt): CompletionResponse;

    abstract public function modelName(): string;

    abstract public function getPromptRequest(PromptRequestType $promptIdentifier): PromptRequest;

    public function describeFile(Project $project, File $file, PromptRequestType $promptRequestIdentifier): CompletionResponse
    {
        $promptRequest = $this->getPromptRequest($promptRequestIdentifier);
        $system = $promptRequest->systemPrompt($project, $file);
        $user = $promptRequest->userPrompt($project, $file);

        return $this->completion($system, $user);
    }
}
