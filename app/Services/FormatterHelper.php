<?php

namespace App\Services;

use Illuminate\Support\Str;

class FormatterHelper
{
    public static function convertArrayKeysToLowerCase(array $data): array
    {
        return collect($data)->map(function ($item) {
            if (is_array($item)) {
                return self::convertArrayKeysToLowerCase($item);
            }

            return $item;
        })->mapWithKeys(function ($value, $key) {
            return [Str::lower($key) => $value];
        })->all();
    }
}
