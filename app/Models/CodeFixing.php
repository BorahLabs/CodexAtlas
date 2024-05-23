<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodeFixing extends Model
{
    use HasFactory;

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
