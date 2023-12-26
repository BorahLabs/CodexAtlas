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

    public function apiCall(string $domain, string $id = null): string
    {
        return match($this) {
            static::GetAllSpaces => 'https://' . $domain  . '/wiki/api/v2/spaces',
            static::GetAllPagesFromSpace => 'https://' . $domain  . '/wiki/api/v2/spaces/' . $id . '/pages',
            static::CreateFolder => 'https://' . $domain  . '/wiki/api/v2/pages',
            static::CreatePage => 'https://' . $domain  . '/wiki/api/v2/pages',
            static::UpdatePage => 'https://' . $domain  . '/wiki/api/v2/pages/' . $id,
            static::DeletePage => 'https://' . $domain  . '/wiki/api/v2/pages/' . $id,
        };
    }
}
