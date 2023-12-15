<?php

namespace App\Models;

use App\Enums\SourceCodeProvider;
use App\SourceCode\Contracts\SourceCodeProvider as ContractsSourceCodeProvider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class SourceCodeAccount extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $casts = [
        'provider' => SourceCodeProvider::class,
    ];

    public static function booted()
    {
        parent::booted();
        static::addGlobalScope('withoutLocal', fn (Builder $query) => $query->where('provider', '!=', SourceCodeProvider::LocalFolder));
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function repositories(): HasMany
    {
        return $this->hasMany(Repository::class);
    }

    public function getProvider(): ContractsSourceCodeProvider
    {
        return $this->provider->provider()->withCredentials($this);
    }
}
