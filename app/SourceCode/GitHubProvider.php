<?php

namespace App\SourceCode;

use App\Actions\Github;
use App\Actions\Github\Auth\GetAuthenticatedAccountGithubClient;
use App\Exceptions\ExceededProviderRateLimit;
use App\SourceCode\Contracts\DownloadsZipFile;
use App\SourceCode\Contracts\HandlesWebhook;
use App\SourceCode\Contracts\RegistersWebhook;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\Traits\LoadFilesFromS3;
use Github\Exception\ApiLimitExceedException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;

class GitHubProvider extends SourceCodeProvider implements DownloadsZipFile, HandlesWebhook, RegistersWebhook
{
    use LoadFilesFromS3;

    public function repositories(): array
    {
        try {
            return Github\GetAllRepositories::make()->handle($this->credentials());
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit(min(900, $e->getResetTime()));
        }
    }

    public function repository(RepositoryName $repository): Repository
    {
        try {
            return Github\GetRepository::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit(min(900, $e->getResetTime()));
        }
    }

    public function branches(RepositoryName $repository): array
    {
        try {
            return Github\GetBranches::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceedException $e) {
            throw new ExceededProviderRateLimit(min(900, $e->getResetTime()));
        }
    }

    public function archive(RepositoryName $repository, Branch $branch, Filesystem $disk, string $zipPath): string
    {
        $client = GetAuthenticatedAccountGithubClient::make()->handle($this->credentials());
        /**
         * @var \Github\Api\Repo
         */
        $api = $client->api('repo');
        $response = $api->contents()->archive($repository->username, $repository->name, 'zipball', $branch->name);

        $disk->put($zipPath, $response);

        return $zipPath;
    }

    public function icon(): string
    {
        return 'codex.icons.github';
    }

    public function name(): string
    {
        return 'GitHub';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://github.com/'.$repository->fullName;
    }

    public function registerWebhook(RepositoryName $repository)
    {
        return Github\RegisterWebhook::make()->handle($this->credentials(), $repository);
    }

    public function verifyIncomingWebhook(Request $request)
    {
        return Github\VerifyWebhook::make()->handle($this->credentials(), $request);
    }

    public function handleIncomingWebhook(array $payload, Request $request)
    {
        return Github\HandleWebhook::make()->handle($this->credentials(), $payload, $request);
    }
}
