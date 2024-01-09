<?php

namespace App\Http\Controllers;

use App\Models\ContentPlatformAccount;
use Unirest\Request;

class ConfluenceTestingApi extends Controller
{
    public function testingAll()
    {

        $contentAccount = ContentPlatformAccount::first();

        Request::auth('raul.sanchez@borah.agency', env('CONFLUENCE_RAUL_XIQUITO_API_TOKEN'));

        $headers = [
            'Accept' => 'application/json',
        ];

        // static::GetFolder            => 'https://' . $domain  . '/wiki/api/v2/pages/' . $id,
        $response = Request::get(
            'https://borah.atlassian.net/wiki/api/v2/pages/1376214',
            $headers
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
