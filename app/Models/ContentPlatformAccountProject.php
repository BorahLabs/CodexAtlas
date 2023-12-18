<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ContentPlatformAccountProject extends Pivot
{
    public function contentPlatformAccount(): BelongsTo
    {
        return $this->belongsTo(ContentPlatformAccount::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
