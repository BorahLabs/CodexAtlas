<?php

namespace App\Actions\Gitlab;

use App\Actions\Gitlab\Auth\GetAuthenticatedAccountGitlabClient;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\RepositoryName;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterWebhook
{
    use AsAction;

    // public function handle(SourceCodeAccount $account, RepositoryName $repositoryName, string $description = null, string $url, array $events = ['repo:push'])
    public function handle()
    {
        // Usar el sourceCodeAccount que llegue por parámetro
        $account = SourceCodeAccount::where('name', 'raulcalima')->first();
        $client = GetAuthenticatedAccountGitlabClient::make()->handle($account);

        // Cambiar por un repoName que llegue por parámetro
        $repository = new RepositoryName(
            username: 'hola',
            name: 'test',
        );
        $projectId = GetProjectIdForRepository::make()->handle($account, $repository);
        // TIENE PINTA QUE VA POR AQUÍ
        // ENTRAR Al METODO systemHooks PARA VER LOS CREATES, UPDATES...
        $hooks = $client->systemHooks()->all();

        return [];
    }
}
