<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthApiHeaders;
use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Models\SourceCodeAccount;
use App\Services\GetUuidFromJson;
use App\SourceCode\DTO\Repository;
use App\SourceCode\DTO\RepositoryName;
use Bitbucket\ResultPager;
use Illuminate\Support\Facades\Http;
use Lorisleiva\Actions\Concerns\AsAction;

class RegisterWebhook
{
    use AsAction;

    // public function handle(SourceCodeAccount $account, RepositoryName $repositoryName, string $description = null, string $url, array $events = ['repo:push'])
    public function handle()
    {
        $account = SourceCodeAccount::where('name', 'raulcalima')->first();
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);
        // EJEMPLO DE PARAMS
        //      [
        //       'description' => 'Test webhook',
        //       'url' => env('APP_URL') . '/bitbucket-webhook',
        //       'events' => ['repo:push'],
        //       'active' => true
        //      ]
        // $params = [
        //     'description' => $description ?? '',
        //     'url'=> $url,
        //     'events' => $events,
        // ];
        // CREA WEBHOOK. Especificar workspace - repositorio - datos del webhook
        // $api = $client->repositories()->workspaces($repositoryName->workspace)->hooks($repositoryName->name)->create(['description' => 'Test webhook','url' => env('APP_URL') . '/bitbucket-webhook', 'events' => ['repo:push']]);

        // Creaa webhook en repo de test de bamboo
        dd('cuidaaaaao');
        $api = $client->repositories()->workspaces('bamboo-workspace')->hooks('test')->create(['description' => 'Test webhook','url' => env('APP_URL') . '/bitbucket/webhook', 'events' => ['repo:push'], 'active' => true]);

        // List los webhooks de un repositorio concreto dentro de un workspace
        // $paginator = new ResultPager($client);

        // $api = $client->repositories()
        //     ->workspaces($repository->workspace)
        //     ->refs($repository->name)
        //     ->branches();

        // $branches = $paginator->fetchAll($api, 'list');

        // $code = urlencode(json_encode("8d9f6fae-81b7-4c6a-9e74-4855e3b79ad4"));
        // $api = $client->repositories()->workspaces('bamboo-workspace')->hooks('test')->show($code);

        // // $api = $client->repositories()->workspaces('bamboo-workspace')->hooks('test');

        // // $hooks = $paginator->fetchAll($api, 'list');

        //     dd($code, $api);
        // dd($paginator->fetchAll($api, 'list'));

        // Guarda el id del webhook en la source code account que llega por parámetro
        // $account->webhook_uuid = GetUuidFromJson::getUuid($api['uuid']);
        // $account->save();


        return [];
    }
}
