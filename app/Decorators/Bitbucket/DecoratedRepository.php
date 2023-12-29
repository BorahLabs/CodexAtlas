<?php

namespace App\Decorators\Bitbucket;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\HttpClient\Util\UriBuilder;
use Illuminate\Support\Facades\Http;

class DecoratedRepository extends AbstractWorkspacesApi
{
    public function __construct(
        private \Bitbucket\Api\Repositories\Workspaces $api,
        string $workspace,
        string $repo,
    ) {
        parent::__construct($api->getClient(), $workspace, $repo);
    }

    public function archive(string $username, string $password, string $branch): mixed
    {
        $response = Http::withBasicAuth($username, $password)
            ->get('https://bitbucket.org/'.$this->workspace.'/'.$this->repo.'/get/'.$branch.'.zip')
            ->throw()
            ->body();

        return $response;
    }

    protected function buildSrcUri(string ...$parts): string
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'archive', 'zip');
    }

    public function __call(string $name, mixed $arguments)
    {
        return $this->api->{$name}(...$arguments);
    }
}
