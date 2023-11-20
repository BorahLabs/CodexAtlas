<?php

namespace App\Models;

use App\SourceCode\DTO\Branch as DTOBranch;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Branch extends Model
{
    use HasFactory;
    use HasUuids;

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }

    public function systemComponents(): HasMany
    {
        return $this->hasMany(SystemComponent::class);
    }

    public function dto(): DTOBranch
    {
        return new DTOBranch(
            name: $this->name,
        );
    }
}
