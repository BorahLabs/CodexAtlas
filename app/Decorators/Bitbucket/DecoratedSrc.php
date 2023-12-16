<?php

namespace App\Decorators\Bitbucket;

use Bitbucket\Api\Repositories\Workspaces\AbstractWorkspacesApi;
use Bitbucket\HttpClient\Util\UriBuilder;

class DecoratedSrc extends AbstractWorkspacesApi
{
    public function __construct(
        private \Bitbucket\Api\Repositories\Workspaces\Src $src,
        string $workspace,
        string $repo,
    ) {
        parent::__construct($src->getClient(), $workspace, $repo);
    }

    public function list(string $commit, string $folder = '/', array $params = [])
    {
        if ($folder === '/') {
            $uri = str($this->buildSrcUri($commit))->finish('/');
        } else {
            $uri = str($this->buildSrcUri($commit, str($folder)->trim('/')))->finish('/');
        }

        return $this->get($uri, $params);
    }

    protected function buildSrcUri(string ...$parts)
    {
        return UriBuilder::build('repositories', $this->workspace, $this->repo, 'src', ...$parts);
    }

    public function __call($name, $arguments)
    {
        return $this->src->{$name}(...$arguments);
    }
}
