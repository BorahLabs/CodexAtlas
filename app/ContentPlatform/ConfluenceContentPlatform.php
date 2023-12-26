<?php

namespace App\ContentPlatform;

use App\Actions\Codex\Architecture\SystemComponents;
use App\Actions\Confluence\Auth\GetAuthHeaders;
use App\ContentPlatform\Contracts\ContentPlatform;
use App\Enums\ConfluenceApiCalls;
use App\Models\ContentPlatformAccount;
use App\Models\SystemComponent;
use CloudPlayDev\ConfluenceClient\ConfluenceClient;
use Illuminate\Support\Env;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Unirest\Request;

class ConfluenceContentPlatform extends ContentPlatform
{

    public function authenticateUser($email = null, $accessToken = null)
    {
        Request::auth('raul.sanchez@borah.agency', env('CONFLUENCE_RAUL_XIQUITO_API_TOKEN'));
    }

    public function handleSynchronizeAction(SystemComponent $systemComponent)
    {
        // Detect if you have to create project folder, page, update a page or delete
        throw new \Exception('Not implemented');
    }

    public function getFolder(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    public function createFolder(SystemComponent $systemComponent, $domain, $name)
    {
        $headers = GetAuthHeaders::run();
        $apiCall = ConfluenceApiCalls::CreateFolder->apiCall($domain, $name);
        $this->authenticateUser();
         // CREAR UN FOLDER PAGE

        // GET SPACE ID FROM ContentPlatformAccountProject model
        $spaceId = 524290;

        $body = json_encode(
        [
          "spaceId"=> "$spaceId",
          "status"=> "current",
          "title"=> "$name",
          "private"=> true,
          "body"=> [
              "representation"=> "storage",
              "value"=> ""
          ],
          'metadata' => [
            'properties' => [
                'content-template' => ['value' => ['key' => 'com.atlassian.confluence.plugins.confluence-content-template:folder']]
            ]
            ]
          ]);

        $response = Request::post($apiCall, $headers, $body);

        return $response;
    }

    public function createPage(SystemComponent $systemComponent, $domain)
    {
        $headers = GetAuthHeaders::run();
        $apiCall = ConfluenceApiCalls::CreatePage->apiCall($domain);
        $this->authenticateUser();

        // PROBLEMA: el content incluye código pero luego no se ve encapsulado en tipo código en la page generada
        $content = Str::markdown($systemComponent->content);

        // GET SPACE ID FROM ContentPlatformAccountProject model
        $spaceId = 524290;

        // GET PARENT ID FROM ContentPlatformAccountProject model
        $parentId = 1376294;

        $pageTitle = $systemComponent->basename;


        $body = json_encode(
        [
          "spaceId"=> "$spaceId",
          "status"=> "current",
          "title"=> "$pageTitle",
          "parentId"=> "$parentId",
          "private"=> true,
          "body"=> [
              "representation"=> "storage",
              "value"=> "$content"
              ]
          ]);

        $response = Request::post($apiCall, $headers, $body);

        return $response;
    }

    // Puede que el pageId lo saquemos de buscar en todas las pages del space concreto con el GetPage o GetAllPages de la Enum\ConfluenceApiCalls
    public function updatePage(SystemComponent $systemComponent, $domain, $pageId)
    {
        $headers = GetAuthHeaders::run();
        $apiCall = ConfluenceApiCalls::UpdatePage->apiCall($domain, $pageId);
        $this->authenticateUser();

        // Conseguir de alguna manera el title de la page ya que es required en la llamada a la api
        $pageTitle = 'Test';

        // Texto que se añade a la versión. Podría ser el nombre del commit o algo arbitrario
        $message = 'Update';

        // PROBLEMA: el content incluye código pero luego no se ve encapsulado en tipo código en la page generada
        $content = Str::markdown($systemComponent->content);

        // IMPORTANTE: version hay que incrementarlo en uno por lo que hay que recoger previamente la versión que tiene la page para sumarle uno a la versión xd
        $body = json_encode(
        [
            "id"=> "$pageId",
            "status"=> "current",
            "title"=> "Testeo desde vs code 1 para folder",
            "private"=> true,
            "body"=> [
                "representation"=> "storage",
                "value"=> "$content"
            ],
            "version"=> [
                "number"=> 2,
                "message"=> "message"
                ]
            ]);


        $response = Request::put($apiCall, $headers, $body);

        return $response;
    }

    public function renamePage(SystemComponent $systemComponent)
    {
        throw new \Exception('Not implemented');
    }

    // Puede que el pageId lo saquemos de buscar en todas las pages del space concreto con el GetPage o GetAllPages de la Enum\ConfluenceApiCalls
    public function deletePage(SystemComponent $systemComponent, $domain, $pageId)
    {
        $apiCall = ConfluenceApiCalls::DeletePage->apiCall($domain, $pageId);
        $this->authenticateUser();

        $response = Request::delete($apiCall);

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
        // $response = Request::get(
        //     'https://borah.atlassian.net/wiki/api/v2/spaces/524290/pages',
        //     $headers
        // );
        // FIN DE BUSCAR TODAS LAS PAGES

        dd($response);

        return [];
    }
}
