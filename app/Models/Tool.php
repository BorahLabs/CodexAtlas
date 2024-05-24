<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public static function codeFixer(): Tool
    {
        return static::query()->where('name', 'code-fixer')->firstOrFail();
    }

    public function codeFixings(): HasMany
    {
        return $this->hasMany(CodeFixing::class);
    }

    public function todayIpCodeFixingRequests(string $ip)
    {
        return $this->codeFixings()
                ->where('ip', $ip)
                ->where('created_at', '>=', now()->startOfDay())
                ->where('created_at', '<=', now()->endOfDay());
    }
}
