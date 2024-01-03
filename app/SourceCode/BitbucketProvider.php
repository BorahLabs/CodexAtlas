<?php

namespace App\SourceCode;

use App\Actions\Bitbucket;
use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Decorators\Bitbucket\DecoratedRepository;
use App\Exceptions\ExceededProviderRateLimit;
use App\SourceCode\Contracts\AccountInfoProvider;
use App\SourceCode\Contracts\HandlesWebhook;
use App\SourceCode\Contracts\RegistersWebhook;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Account;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use App\SourceCode\Traits\LoadFilesFromS3;
use Bitbucket\Exception\ApiLimitExceededException;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\Request;

class BitbucketProvider extends SourceCodeProvider implements AccountInfoProvider, HandlesWebhook, RegistersWebhook
{
    use LoadFilesFromS3;

    public function repositories(): array
    {
        try {
            return Bitbucket\GetAllRepositories::make()->handle($this->credentials());
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(900);
        }
    }

    public function repository(RepositoryName $repository): Repository
    {
        try {
            return Bitbucket\GetRepository::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(900);
        }
    }

    public function branches(RepositoryName $repository): array
    {
        try {
            return Bitbucket\GetBranches::make()->handle($this->credentials(), $repository);
        } catch (ApiLimitExceededException $e) {
            throw new ExceededProviderRateLimit(900);
        }
    }

    public function archive(RepositoryName $repository, Branch $branch, Filesystem $disk, string $zipPath): string
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($this->credentials());
        $api = new DecoratedRepository(
            api: $client->repositories()->workspaces($repository->workspace),
            workspace: $repository->workspace,
            repo: $repository->name
        );

        $response = $api
            ->archive($this->credentials()->name, $this->credentials()->access_token, $branch->name);

        $disk->put($zipPath, $response);

        return $zipPath;
    }

    public function icon(): string
    {
        return 'codex.icons.bitbucket';
    }

    public function name(): string
    {
        return 'Bitbucket';
    }

    public function url(RepositoryName $repository): string
    {
        return 'https://bitbucket.com/'.$repository->fullName;
    }

    public function account(): Account
    {
        return Bitbucket\GetAccount::make()->handle($this->credentials());
    }

    public function registerWebhook(RepositoryName $repository): mixed
    {
        return Bitbucket\RegisterWebhook::make()->handle($this->credentials(), $repository);
    }

    public function verifyIncomingWebhook(Request $request): mixed
    {
        return Bitbucket\VerifyWebhook::make()->handle($this->credentials(), $request);
    }

    public function handleIncomingWebhook(array $payload, Request $request): mixed
    {
        return Bitbucket\HandleWebhook::make()->handle($this->credentials(), $payload, $request);
    }
}
