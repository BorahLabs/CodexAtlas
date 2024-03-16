<?php

namespace App\Actions\PullRequestAssistant\Github;

use App\LLM\Contracts\Llm;
use GuzzleHttp\Client;
use Lorisleiva\Actions\Concerns\AsAction;

class SendRequestToLLM
{
    use AsAction;

    public function handle(string $requestChangesFileLines, $commentContent)
    {
        $prompt = 'I am giving to you an array with this format: '.$requestChangesFileLines.'. Each /n means a new line in the file and I want you give me back the same format but: '.$commentContent;
        $systemPrompt = 'You are an expert in modifying files changing exactly only the things you are asked to and return the same format you are asked';

        $llm = app(Llm::class);
        $response = $llm->completion($systemPrompt, $prompt);
        $formattedResponse = $this->formatResponse($response->completion);
        if (! array_key_exists(0, $formattedResponse)) {
            return [];
        }

        return json_decode($formattedResponse[0]);
    }


    private function formatResponse($content)
    {
        preg_match("/\[(.*?)\]/", $content, $formattedResponse);

        return $formattedResponse;
    }
}
