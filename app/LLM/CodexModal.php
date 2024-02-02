<?php

namespace App\LLM;

use App\LLM\Contracts\Llm;
use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;
use Illuminate\Support\Facades\Http;
use OpenAI\Client;

class CodexModal extends Llm
{
    public function fileDescriptionSystemPrompt(Project $project, File $file): string
    {
        return 'You are an expert in writing software documentation. Write a short description of the provided file with the following structure:

## TLDR
[General overview of what the file does]

## Methods (if applicable)
### `method1Name`
[Description of what the method 1 does in the code]

### `method2Name`
[Description of what the method 2 does in the code]

### `methodNName`
[Description of what the method n does in the code]

## Classes (if applicable)
### Class 1 name
[Description of what the class 1 does in the code]

### Class 2 name
[Description of what the class 2 does in the code]

### Class n name
[Description of what the class n does in the code]

Some rules:

- Format the output using Markdown. Feel free to add bold, italic or even tables if you need them
- Do not output the original file
- Finish the documentation by writing "END" in a new line
- If there are no methods or no classes, please do not include the section in the output';
    }

    public function fileDescriptionUserPrompt(Project $project, File $file): string
    {
        return 'You are writing documentation for a file in the '.$project->name.' project. The file is located at '.$file->path.'. These are the file contents:
```'.$file->extension().'
'.$file->contents().'
```';
    }

    public function modelName(): string
    {
        return 'tgi';
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        // wrapping on a retry function to avoid the limit per minute error
        $response = retry(3, fn () => Http::post(config('services.modal.codex.describe_file_endpoint'), [
            'system' => $systemPrompt,
            'user' => $userPrompt,
            'max_tokens' => 1024,
        ])->json(), 61500);
        $end = intval(microtime(true) * 1000);

        return CompletionResponse::make(
            completion: $response['text'],
            processingTimeMilliseconds: $end - $start,
            inputTokens: 0,
            outputTokens: 0,
            totalTokens: $response['num_tokens'],
        );
    }
}
