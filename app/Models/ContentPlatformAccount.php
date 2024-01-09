<?php

namespace App\Models;

use App\Enums\ContentPlatform;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ContentPlatformAccount extends Model
{
    use HasFactory;
    use HasUuids;

    protected $casts = [
        'access_token' => 'encrypted',
        'refresh_token' => 'encrypted',
        'platform' => ContentPlatform::class,
    ];

    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class)->using(ContentPlatformAccountProject::class);
    }

    public function branchContentPlatformFolders(): HasMany
    {
        return $this->hasMany(BranchContentPlatformFolder::class);
    }
}
