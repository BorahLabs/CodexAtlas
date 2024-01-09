<?php

namespace App\Enums;

enum ConfluenceApiCalls: string
{
    case GetAllSpaces = 'get-spaces';
    case GetAllPagesFromSpace = 'get-pages-from-space';
    case CreateFolder = 'create-folder';
    case CreatePage = 'create-page';
    case UpdatePage = 'update-page';
    case DeletePage = 'delete-page';
    case GetFolder = 'get-folder';
    case GetPage = 'get-page';

    public function endpoint(string $domain, ?string $id = null): string
    {
        return match ($this) {
            self::GetAllSpaces => 'https://'.$domain.'/wiki/api/v2/spaces',
            self::GetAllPagesFromSpace => 'https://'.$domain.'/wiki/api/v2/spaces/'.$id.'/pages',
            self::CreateFolder => 'https://'.$domain.'/wiki/api/v2/pages',
            self::CreatePage => 'https://'.$domain.'/wiki/api/v2/pages',
            self::UpdatePage => 'https://'.$domain.'/wiki/api/v2/pages/'.$id,
            self::DeletePage => 'https://'.$domain.'/wiki/api/v2/pages/'.$id,
            self::GetFolder => 'https://'.$domain.'/wiki/api/v2/pages/'.$id,
            self::GetPage => 'https://'.$domain.'/wiki/api/v2/pages/'.$id,
        };
    }
}
