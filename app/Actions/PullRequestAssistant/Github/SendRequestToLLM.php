<?php

namespace App\Actions\PullRequestAssistant\Github;

use GuzzleHttp\Client;
use Lorisleiva\Actions\Concerns\AsAction;

class SendRequestToLLM
{
    use AsAction;

    public function handle(string $requestChangesFileLines, $commentContent)
    {
        $prompt = 'I am giving to you an array with this format: '.$requestChangesFileLines.'. Each /n means a new line in the file and I want you give me back the same format but: '.$commentContent;
        $response = $this->makeOpenAIRequest($prompt);
        $formattedResponse = $this->formatResponse($response->choices[0]->message->content);

        if (! array_key_exists(0, $formattedResponse)) {
            return [];
        }

        return json_decode($formattedResponse[0]);
    }

    private function makeOpenAIRequest(string $prompt)
    {
        $client = new Client();
        $response = $client->request('POST', 'https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer '.config('services.openAI.token'),
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'gpt-3.5-turbo',
                'messages' => [
                    [
                        'role' => 'user',
                        'content' => $prompt,
                    ],
                ],
            ],
        ]);

        return json_decode($response->getBody()->getContents());
    }

    private function formatResponse($content)
    {
        preg_match("/\[(.*?)\]/", $content, $formattedResponse);

        return $formattedResponse;
    }
}
