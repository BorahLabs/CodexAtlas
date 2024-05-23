<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\PromptRequest;
use App\LLM\Contracts\SimplePromptRequest;
use App\Models\Project;
use App\SourceCode\DTO\File;
use Exception;

class CodeFixerPromptRequest implements SimplePromptRequest
{
    public function systemPrompt(array $data): string
    {
        if(!data_get($data, 'code') || !data_get($data, 'codeError')){
            throw new Exception('[Code Fixer] Missing parameters');
        }

        return 'You are an expert in solving software issues. You will receive a piece of code and an error given by this code. Correct the code and give a solution in code with the provided parameters in JSON format with the following structure:

        [KEY] response
        [VALUE] code in markdown

        Some rules:
        - Response JSON Always should have key response.
        - [KEY] Means the key of the json and the [VALUE] means the value that should be in this key.
        - Do not output the original code
        - Dont add \n, Only the json is required';
    }

    public function userPrompt(array $data): string
    {
        if(!data_get($data, 'code') || !data_get($data, 'codeError')){
            throw new Exception('[Code Fixer] Missing parameters');
        }

        return 'You are solving a code issue. These are the code and error contents respectively:
            ```'.$data['code'].'
            '.$data['codeError'].'
            ```';
    }
}
