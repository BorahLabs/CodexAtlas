<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }

    public function systemComponents(): HasMany
    {
        return $this->hasMany(SystemComponent::class);
    }
}
