<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ContentPlatformAccountSystemComponent extends Pivot
{
    public function contentPlatformAccount()
    {
        return $this->belongsTo(ContentPlatformAccount::class);
    }

    public function systemComponent()
    {
        return $this->belongsTo(SystemComponent::class);
    }
}
