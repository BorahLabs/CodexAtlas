<?php

namespace App\Services;

class GetUuidFromJson
{
    public static function getUuid(string $uuid): string
    {
        return str_replace(['{', '}'], '', $uuid);
    }
}
