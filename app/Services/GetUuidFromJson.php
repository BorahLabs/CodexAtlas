<?php

namespace App\Services;

class GetUuidFromJson
{
    public static function getUuid($uuid): string
    {
        return str_replace(['{', '}'], '', $uuid);
    }
}
