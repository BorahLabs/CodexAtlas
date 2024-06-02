<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\SimplePromptRequest;

class GenerateCodeConversionContentPromptRequest implements SimplePromptRequest
{
    public function systemPrompt(array $data): string
    {
        return 'You are an expert in programming, SEO and copywriting. You need to write between 500 and 1000 words on how to convert from '.$data['from'].' to '.$data['to'].'.

        <rules>
        - Return the response in Markdown format between <markdown> and </markdown> tags
        - You are only allowed to use H2-H6, never an H1
        - You are not allowed to add links or images, but you can use bold, italic, underlines or tables to add better emphasis on some parts
        - Separate the content in different sections and paragraphs if needed, properly using H2-H6 for that
        - Only talk about converting from '.$data['from'].' to '.$data['to'].' in that specific order
        - You should assume that the person that will read this is proficient in '.$data['from'].' but not so much in '.$data['to'].', so you are allowed to be technical while explaining the details
        - You should optimize the titles for SEO knowing that the main keyword we are targeting is "Free '.$data['from'].' to '.$data['to'].' Code Converter"
        </rules>';
    }

    public function userPrompt(array $data): string
    {
        return '<markdown>## How to convert from '.$data['from'].' to '.$data['to'];
    }
}
