<?php

namespace App\Models;

use App\SourceCode\DTO\RepositoryName;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repository extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    public function sourceCodeAccount(): BelongsTo
    {
        return $this->belongsTo(SourceCodeAccount::class);
    }

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function branches(): HasMany
    {
        return $this->hasMany(Branch::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(RepositoryPage::class);
    }

    public function fullName(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->username.'/'.$this->name,
        );
    }

    public function url(): string
    {
        return $this->sourceCodeAccount->getProvider()->url($this->nameDto());
    }

    public function nameDto(): RepositoryName
    {
        return new RepositoryName(
            username: $this->username,
            name: $this->name,
            workspace: $this->workspace,
        );
    }
}
