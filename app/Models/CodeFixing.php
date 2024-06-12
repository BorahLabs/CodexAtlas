<?php

namespace App\Models;

use App\Models\Traits\HasUserFeedback;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CodeFixing extends Model
{
    use HasFactory;
    use HasUserFeedback;

    protected $casts = [
        'code' => 'encrypted',
        'code_error' => 'encrypted',
        'response' => 'encrypted',
    ];

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }
}
