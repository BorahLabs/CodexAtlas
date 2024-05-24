<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\SimplePromptRequest;
use Exception;

class CodeFixerPromptRequest implements SimplePromptRequest
{
    public function systemPrompt(array $data): string
    {
        if (! data_get($data, 'code') || ! data_get($data, 'codeError')) {
            throw new Exception('[Code Fixer] Missing parameters');
        }

        return 'You are an expert in solving software issues. You will receive a piece of code and an error given by this code. Correct the code and give a solution in code with the provided parameters in JSON format with the following structure:

        ```json
        {
            "response": "```code\nFixed code```"
        }

        Some rules:
        - Only return the JSON response
        - Make sure to add the code block with the right language after the backticks, so that the Markdown gets parsed correctly';
    }

    public function userPrompt(array $data): string
    {
        if (! data_get($data, 'code') || ! data_get($data, 'codeError')) {
            throw new Exception('[Code Fixer] Missing parameters');
        }

        return 'You are solving a code issue. These are the code and error contents respectively:
            ```'.$data['code'].'
            '.$data['codeError'].'
            ```';
    }
}
