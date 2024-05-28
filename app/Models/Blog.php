<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Builder;

class Blog extends Model
{
    use HasFactory, HasSlug;


    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function imageUrl(): Attribute
    {
            return Attribute::make(
            get: fn () => Storage::url($this->image),
        );
    }

    public function isVisible(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_active && $this->published_at <= now(),
        );
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        if (!auth()->user() || (auth()->user() && !auth()->user()->emailIsFromCodex())) {
            static::addGlobalScope('actives', function (Builder $builder) {
                $builder->where('is_active', true)->whereDate('published_at', '<=', now());
            });
        }
    }

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function getTailGraphUrl()
    {
        $image = 'https://og.tailgraph.com/og
                    ?fontFamily=Roboto
                    &title=' . json_encode($this->title) . '
                    &titleTailwind=text-gray-800%20font-bold%20text-6xl
                    &text=' . json_encode($this->excerpt) . '
                    &textTailwind=text-gray-700%20text-2xl%20mt-4
                    &logoUrl=' . json_encode($this->image_url) . '
                    &logoTailwind=h-64
                    &bgTailwind=bg-dark
                    &footer=tailgraph.com
                    &footerTailwind=text-teal-600';

        return $image;
    }
}
