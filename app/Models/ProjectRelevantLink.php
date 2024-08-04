<?php

namespace App\Models;

use App\Actions\Onboarding\FetchProjectRelevantLinkFavicon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectRelevantLink extends Model
{
    use HasFactory;

    protected static function boot()
    {
        parent::boot();

        static::saved(function (ProjectRelevantLink $link) {
            FetchProjectRelevantLinkFavicon::dispatch($link);
        });
    }
}
