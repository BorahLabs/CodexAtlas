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
        try {
            $response = $this->client->request($request->getMethod(), $request->getUri(), $options);
            return $request->transformResponse(json_decode($response->getBody()->getContents(), true));
        } catch(ClientException $e) {
            return $this->handleException($e, $request);
        }
    }

    private function setClient(GithubRequest $githubRequest)
    {
        $this->client = new Client([
            'base_uri' => config('services.gh.api_endpoint'),
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

        if ($request->getQueryParams()) {
            $options['query'] = $request->getQueryParams();
        }

        return $options;

    }

    private function handleException(ClientException $e, GithubRequest $request)
    {
        //manage error
        logger($e);
    }
}
