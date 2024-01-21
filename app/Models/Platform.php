<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Platform extends Model
{
    use HasFactory;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function route(string $path, mixed $parameters = []): string
    {
        $url = route($path, $parameters);
        $host = str($url)->after('://')->before('/')->toString();

        return str($url)->replaceFirst($host, $this->domain)->toString();
    }

    public static function current(): ?Platform
    {
        return static::query()
            ->where('domain', request()->getHost())
            ->first();
    }
}
