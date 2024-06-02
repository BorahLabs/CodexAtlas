<?php

namespace App\Models\Traits;

use App\Models\UserFeedback;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasUserFeedback
{
    public function feedback(): MorphOne
    {
        return $this->morphOne(UserFeedback::class, 'model');
    }
}
