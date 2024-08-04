<?php

namespace App\LLM\PromptRequests\OpenAI;

use App\LLM\Contracts\SimplePromptRequest;
use Exception;

class GenerateProjectDescriptionFromUrlPromptRequest implements SimplePromptRequest
{
    public function systemPrompt(array $data): string
    {
        return 'You are an expert in explaining software projects to software engineers in a simple yet explanatory way.
        - The description that you give will be used to onboard new developers into the project, so make sure that you cover everything that is important.
        - You can write the description in Markdown format.
        - Do not start with a title, just go straight to the description.
        - A good description would include the project\'s purpose and the problem it solves.

        You will receive the contents of the project website inside the <input></input> tags. Use this information and nothing else to generate a project description.
        Answer with the generated description between <output></output> tags.';
    }

    public function userPrompt(array $data): string
    {
        if (! data_get($data, 'content')) {
            throw new Exception('[Onboarding] Missing parameters');
        }

        return "<input>".$data['content']."</input>";
    }
}
