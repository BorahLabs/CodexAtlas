<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tool extends Model
{
    use HasFactory;

    protected $casts = [
        'data' => 'array',
    ];

    public function key(string $key): mixed
    {
        return data_get($this->data, $key);
    }

    public static function codeDocumentation(): Tool
    {
        return static::query()->where('name', 'code-documentation')->firstOrFail();
    }
}
