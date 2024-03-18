<?php

namespace App\Clients;

use App\Clients\Requests\Github\Contract\GithubRequest;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class GithubClient {

    private Client $client;

    public function send(GithubRequest $request) {
        $this->setClient($request);
        $options = $this->getOptions($request);
        $response = $this->client->request($request->getMethod(), $request->getUri(), $options);
        return $request->transformResponse(json_decode($response->getBody()->getContents(), true));
    }

    private function setClient(GithubRequest $githubRequest)
    {
        $this->client = new Client([
            'base_uri' => config('services.github.api_endpoint'),
            'headers' => [
                'Authorization' => 'Bearer '.$githubRequest->getAccessToken(),
                'Accept' => 'application/vnd.github.v3+json',
            ]
        ]);
    }

    private function getOptions(GithubRequest $request): array
    {
        $options = [];

        if($request->getBody()) {
            $options['body'] = json_encode($request->getBody());
        }

        return $options;

    }
}
