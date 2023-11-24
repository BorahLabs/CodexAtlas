<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Routing\UrlGenerator;

class Platform extends Model
{
    use HasFactory;

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function route(string $path, $parameters = []): string
    {
        /**
         * @var UrlGenerator
         */
        $generator = app(UrlGenerator::class);
        $generator->forceRootUrl(str($this->domain)->start('https://'));
        return $generator->route($path, $parameters);
    }
}
