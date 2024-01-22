<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomGuide extends Model
{
    use HasFactory;
    use HasUuids;

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }
}
