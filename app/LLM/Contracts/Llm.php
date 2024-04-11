<?php

namespace App\LLM\Contracts;

use App\LLM\DTO\CompletionResponse;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Project;
use App\SourceCode\DTO\File;
use App\Traits\HasFileDTO;
use App\Traits\HasProject;

abstract class Llm
{
    abstract public function completion(string $systemPrompt, string $userPrompt): CompletionResponse;

    abstract public function modelName(): string;

    abstract public function getPromptRequest(PromptRequestType $promptRequestType): PromptRequest;

    public function describeFile(Project $project, File $file, PromptRequestType $promptRequestType): CompletionResponse
    {
        $promptRequest = $this->getPromptRequest($promptRequestType);
        $this->handleClassTraits($promptRequest, $project, $file);
        $system = $promptRequest->systemPrompt($project, $file);
        $user = $promptRequest->userPrompt($project, $file);

        return $this->completion($system, $user);
    }

    private function handleClassTraits(&$promptRequest, $project, $file)
    {
        $classTraits = class_uses($promptRequest);

        if(in_array(HasProject::class, $classTraits)) {
            $promptRequest->setProject($project);
        }

        if(in_array(HasFileDTO::class, $classTraits)) {
            $promptRequest->setFile($file);
        }
    }
}
