<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProjectConcept extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }
}
