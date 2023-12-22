<?php

namespace App\ContentPlatform;

use App\Actions\Codex\Architecture\SystemComponents;
use App\ContentPlatform\Contracts\ContentPlatform;
use App\Models\ContentPlatformAccount;
use App\Models\SystemComponent;
use CloudPlayDev\ConfluenceClient\ConfluenceClient;
use Illuminate\Support\Env;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Unirest\Request;

class ConfluenceContentPlatform extends ContentPlatform
{
    public function createPage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function updatePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function renamePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function deletePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function testingAll()
    {

        $contentAccount = ContentPlatformAccount::first();

        Request::auth('raul.sanchez@borah.agency', env('CONFLUENCE_RAUL_XIQUITO_API_TOKEN'));

        $headers = array(
          'Accept' => 'application/json'
        );

        // Busca todos los spaces del autenticado
        // $response = Request::get(
        //     'https://borah.atlassian.net/wiki/api/v2/spaces',
        //                 $headers
        // );

        // BUSCAR TODAS LAS PAGES DE UN SPACE
        $response = Request::get(
            'https://borah.atlassian.net/wiki/api/v2/spaces/524290/pages',
            $headers
        );
        // FIN DE BUSCAR TODAS LAS PAGES


        // CREAR UNA PAGE
        $headers = array(
          'Accept' => 'application/json',
          'Content-Type' => 'application/json'
        );


        // PROBLEMA: el content incluye código pero luego no se ve encapsulado en tipo código en la page generada
        $content = Str::markdown(SystemComponent::skip(11)->first()->content);
        $body = json_encode(
        [
          "spaceId"=> "524290",
          "status"=> "current",
          "title"=> "Testeo desde vs code 4",
          "parentId"=> "524368",
          "private"=> true,
          "body"=> [

              "representation"=> "storage",
              "value"=> "$content"
              ]
          ]);


        $response = Request::post(
          'https://borah.atlassian.net/wiki/api/v2/pages',
          $headers,
          $body
        );
        // FIN DE CREAR UNA PAGE


        dd($response);

        return [];
    }
}
