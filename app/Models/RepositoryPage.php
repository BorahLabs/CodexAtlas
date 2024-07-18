<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RepositoryPage extends Model
{
    use HasFactory;
    use HasUlids;

    public function repository(): BelongsTo
    {
        return $this->belongsTo(Repository::class);
    }
}
