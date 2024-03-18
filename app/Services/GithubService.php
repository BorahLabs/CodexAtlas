<?php

namespace App\Services;

use App\Clients\GithubClient;
use App\Clients\Requests\Github\GetFileRequest;
use App\Clients\Requests\Github\GetLatestCommitSHARequest;
use App\Clients\Requests\Github\GetParentCommitsRequest;
use App\Clients\Requests\Github\GetTreeSHARequest;
use App\Clients\Requests\Github\MakeCommitRequest;
use App\Clients\Requests\Github\MakePushRequest;

class GithubService {
    public function __construct(
        private GithubClient $client
    ){}

    public function getFileFromRepository(string $repositoryOwner, string $repository, string $branch, string $filePath)
    {
        return $this->client->send(new GetFileRequest($repositoryOwner, $repository, $branch, $filePath));
    }

    public function pushNewContentToRepository(string $repository, string $branch, string $filePath, string $owner, string $newContent, string $commitMessage)
    {
        $latestCommitSHA = $this->getLatestCommitSHA($repository, $branch, $owner);
        $treeSHA = $this->getTree($repository, $filePath, $owner, $newContent, $latestCommitSHA);
        $parentCommits = $this->getParentCommitsSHA($owner, $repository, $branch);
        $newCommitSHA = $this->makeCommit($owner, $repository, $commitMessage, (string)$treeSHA, $parentCommits);
        $this->makePushFromCommitSHA($owner, $repository, $branch, (string)$newCommitSHA);
    }

    private function getLatestCommitSHA(string $repository, string $branch, string $owner)
    {
        return $this->client->send(new GetLatestCommitSHARequest($repository, $branch, $owner));
    }

    private function getTree($repository, $filePath, $owner, $newContent, $latestCommitSHA)
    {
        return $this->client->send(new GetTreeSHARequest($owner, $repository, $filePath , $newContent, $latestCommitSHA));
    }

    private function getParentCommitsSHA(string $owner, string $repository, string $branch)
    {
        return $this->client->send(new GetParentCommitsRequest($owner, $repository, $branch));
    }

    private function makeCommit(string $owner, string $repository, string $commitMessage, string $treeSHA, array $parentCommits)
    {
        return $this->client->send(new MakeCommitRequest($owner, $repository, $commitMessage, $treeSHA, $parentCommits));
    }

    private function makePushFromCommitSHA(string $owner, string $repository, string $branch, string $commitSHA)
    {
        return $this->client->send(new MakePushRequest($owner, $repository, $branch, $commitSHA));
    }
}
