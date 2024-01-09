<?php

namespace App\SourceCode;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Actions\Gitlab\GetProjectIdForRepository;
use App\Actions\Gitlab;
use App\Exceptions\ExceededProviderRateLimit;
use App\SourceCode\Contracts\AccountInfoProvider;
use App\SourceCode\Contracts\DownloadsZipFile;
use App\SourceCode\Contracts\HandlesWebhook;
use App\SourceCode\Contracts\RegistersWebhook;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Account;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\Traits\LoadFilesFromS3;
use Gitlab\Exception\ApiLimitExceededException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;

class GitLabProvider extends SourceCodeProvider implements AccountInfoProvider, DownloadsZipFile, HandlesWebhook, RegistersWebhook
{
    use LoadFilesFromS3;

    public function repositories(): array
    {
        try {
            return Gitlab\GetAllRepositories::make()->handle($this->credentials());
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(900);
        }
    }

    public function repository(RepositoryName $repository): Repository
    {
        try {
            return Gitlab\GetRepository::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(900);
        }
    }

    public function branches(RepositoryName $repository): array
    {
        try {
            return Gitlab\GetBranches::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(900);
        }
    }

    public function archive(RepositoryName $repository, Branch $branch, Filesystem $disk, string $zipPath): string
    {
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($this->credentials());
        $projectId = GetProjectIdForRepository::make()->handle($this->credentials(), $repository);
        $response = $client->repositories()->archive($projectId, [
            'ref' => $branch->name,
        ], 'zip');

        $disk->put($zipPath, $response);

        return $zipPath;
    }

    public function icon(): string
    {
        return 'codex.icons.gitlab';
    }

    public function name(): string
    {
        return 'Gitlab';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://gitlab.com/'.$repository->fullName;
    }

    public function account(): Account
    {
        return Gitlab\GetAccount::make()->handle($this->credentials());
    }

    public function registerWebhook(RepositoryName $repository): mixed
    {
        return Gitlab\RegisterWebhook::make()->handle($this->credentials(), $repository);
    }

    public function verifyIncomingWebhook(Request $request): mixed
    {
        return Gitlab\VerifyWebhook::make()->handle($this->credentials(), $request);
    }

    public function handleIncomingWebhook(array $payload, Request $request): mixed
    {
        return Gitlab\HandleWebhook::make()->handle($this->credentials(), $payload, $request);
    }
}
