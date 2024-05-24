<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;

class CodeFixing extends Model
{
    use HasFactory;

    public function tool(): BelongsTo
    {
        return $this->belongsTo(Tool::class);
    }

    public static function booted(): void
    {
        parent::booted();

        static::creating(function (CodeFixing $codeFixing) {
            $codeFixing->code = Crypt::encryptString($codeFixing->code);
            $codeFixing->code_error = Crypt::encryptString($codeFixing->code_error);
            $codeFixing->response = Crypt::encryptString($codeFixing->response);
        });
    }

    public function decryptedCode(): Attribute
    {
        return Attribute::make(
            get: fn () => Crypt::decryptString($this->code),
        );
    }

    public function decryptedCodeError(): Attribute
    {
        return Attribute::make(
            get: fn () => Crypt::decryptString($this->code_error),
        );
    }

    public function decryptedResponse(): Attribute
    {
        return Attribute::make(
            get: fn () => Crypt::decryptString($this->response),
        );
    }

}
