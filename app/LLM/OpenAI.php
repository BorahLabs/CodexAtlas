<?php

namespace App\LLM;

use App\LLM\Contracts\HasApiKey;
use App\LLM\Contracts\Llm;
use App\LLM\DTO\CompletionResponse;
use App\Models\Project;
use App\SourceCode\DTO\File;
use OpenAI\Client;

class OpenAI extends Llm implements HasApiKey
{
    private ?string $key = null;

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
        return config('services.openai.completion_model');
    }

    public function completion(string $systemPrompt, string $userPrompt): CompletionResponse
    {
        $start = intval(microtime(true) * 1000);
        // wrapping on a retry function to avoid the limit per minute error
        $response = retry(3, fn () => $this->client()->chat()->create([
            'model' => $this->modelName(),
            'messages' => [
                [
                    'role' => 'system',
                    'content' => $systemPrompt,
                ],
                [
                    'role' => 'user',
                    'content' => $userPrompt,
                ],
            ],
            'stop' => ['-----', "\nEND"],
        ]), 61500);
        $end = intval(microtime(true) * 1000);

        return CompletionResponse::make(
            completion: $response->choices[0]->message->content,
            processingTimeMilliseconds: $end - $start,
            inputTokens: $response->usage->promptTokens,
            outputTokens: $response->usage->completionTokens,
            totalTokens: $response->usage->totalTokens,
        );
    }

    public function embed(string ...$texts): array
    {
        $response = $this->client()->embeddings()->create([
            'model' => config('services.openai.embeddings_model'),
            'input' => $texts,
        ]);

        return collect($response->embeddings)
            ->map(fn (mixed $item) => $item->embeddings)
            ->toArray();
    }

    public function checkApiKey(string $key): bool
    {
        try {
            $this->client($key)->models()->list();
        } catch (\Exception $e) {
            return false;
        }

        return true;
    }

    public function usingApiKey(?string $key): static
    {
        $this->key = $key;

        return $this;
    }

    private function client(?string $key = null): Client
    {
        return (new \OpenAI\Factory())
            ->withApiKey($key ?? $this->key ?? config('openai.api_key'))
            ->make();
    }
}
