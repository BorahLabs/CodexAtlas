<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected static function boot()
    {
        parent::boot();

        static::creating(function (Project $project) {
            if (is_null($project->team_id)) {
                $project->team_id = auth()->user()->currentTeam->id;
            }
        });
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function repositories(): HasMany
    {
        return $this->hasMany(Repository::class);
    }

    public function concepts(): HasMany
    {
        return $this->hasMany(ProjectConcept::class);
    }
}
