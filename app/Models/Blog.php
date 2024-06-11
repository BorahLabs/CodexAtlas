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
        'related_blogs' => 'array',
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

    private function deleteRelated($actualBlog)
    {
        $blogs = Blog::query()->whereJsonContains('related_blogs', (string) $actualBlog->id)->get();

        $blogs->each(function ($blog) use ($actualBlog) {
            $relateds = collect($blog->related_blogs);

            $newRelateds = $relateds->reject(function ($value) use ($actualBlog) {
                return $value == $actualBlog->id;
            })->values()->all();

            $blog->related_blogs = $newRelateds;

            $blog->save();
        });
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {

        static::deleting(function (Blog $blog) {
            $blog->deleteRelated($blog);
        });

        static::saving(function (Blog $blog) {
        });

        if (!auth()->user()?->emailIsFromCodex()) {
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
                    &title=' . urlencode($this->title) . '
                    &titleTailwind=text-gray-800%20font-bold%20text-6xl
                    &text=' . urlencode($this->excerpt) . '
                    &textTailwind=text-gray-700%20text-2xl%20mt-4
                    &logoUrl=' . urlencode($this->image_url) . '
                    &logoTailwind=h-64
                    &bgTailwind=bg-dark
                    &footer=' . config('app.url') . '
                    &footerTailwind=text-teal-600';

        return $image;
    }
}
