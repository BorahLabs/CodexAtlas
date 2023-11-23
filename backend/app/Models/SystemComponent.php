<?php

namespace App\Models;

use App\Enums\SystemComponentStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemComponent extends Model
{
    use HasFactory;
    use HasUuids;
    use SoftDeletes;

    protected $casts = [
        'status' => SystemComponentStatus::class,
    ];

    public function branch(): BelongsTo
    {
        return $this->belongsTo(Branch::class);
    }

    public function folder(): Attribute
    {
        return Attribute::make(
            get: fn () => dirname($this->path),
        );
    }

    public function name(): Attribute
    {
        return Attribute::make(
            get: fn () => basename($this->path),
        );
    }

    public function extension(): Attribute
    {
        return Attribute::make(
            get: fn () => pathinfo($this->path, PATHINFO_EXTENSION),
        );
    }

    public function language(): Attribute
    {
        return Attribute::make(
            get: fn () => match(true) {
                str_ends_with($this->path, '.blade.php') => 'blade',
                default => pathinfo($this->path, PATHINFO_EXTENSION),
            }
        );
    }

    public function content(): Attribute
    {
        return Attribute::make(
            get: function () {
                return $this->markdown_docs . "\n\n```" . $this->language . "\n" . $this->file_contents . "\n```";
            },
        );
    }
}
