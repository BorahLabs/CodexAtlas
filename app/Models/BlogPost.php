<?php

namespace App\Models;

use App\Models\Traits\HasUserFeedback;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class BlogPost extends Model
{
    use HasFactory, HasSlug;
    use HasUserFeedback;

    protected $casts = [
        'published_at' => 'datetime',
        'related_blogs' => 'array',
    ];

    public function imageUrl(): Attribute
    {
        return Attribute::make(
            get: fn () => Storage::temporaryUrl($this->image),
        );
    }

    public function isVisible(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->is_active && $this->published_at <= now(),
        );
    }

    private function deleteRelated(BlogPost $actualBlog): void
    {
        $blogs = BlogPost::query()->whereJsonContains('related_blogs', (string) $actualBlog->id)->get();

        $blogs->each(function (BlogPost $blog) use ($actualBlog) {
            $relateds = collect($blog->related_blogs);

            $newRelateds = $relateds->reject(function (string $value) use ($actualBlog) {
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

        static::deleting(function (BlogPost $blog) {
            $blog->deleteRelated($blog);
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
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function getTailGraphUrl(): string
    {
        $params = [
            'fontFamily' => 'Roboto',
            'title' => $this->title,
            'titleTailwind' => 'text-white font-bold text-6xl',
            'text' => $this->excerpt,
            'textTailwind' => 'text-white opacity-75 text-2xl mt-4 px-12',
            'bgTailwind' => 'bg-[#080C28]',
            'footer' => config('app.url'),
            'footerTailwind' => 'text-violet-500',
        ];
        $image = 'https://og.tailgraph.com/og?'.http_build_query($params);

        return $image;
    }
}
