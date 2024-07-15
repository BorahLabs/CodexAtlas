<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;
use Spatie\SchemaOrg\Schema;

class BlogController extends Controller
{
    public function index(): \Illuminate\Contracts\View\View
    {
        return view('blog.blog-list', [
            'blogs' => BlogPost::query()->get(),
        ]);
    }

    public function detail(BlogPost $blog): \Illuminate\Contracts\View\View
    {
        if (!auth()->user()?->emailIsFromCodex()) {
            abort_if(!$blog->is_visible, 404);
        }

        $blogIds = collect($blog->related_blogs);

        $otherBlogs = BlogPost::query()->whereIn('id', $blogIds)->get();

        $schema = Schema::blogPosting()
            ->headline($blog->title)
            ->articleBody($blog->markdown_content)
            ->author(Schema::person()->name(config('codex.blog_author')))
            ->datePublished($blog->published_at->toIso8601String())
            ->dateModified($blog->updated_at->toIso8601String())
            ->mainEntityOfPage(Schema::webPage()->url(url()->current()))
            ->publisher(Schema::organization()
                ->name('CodexAtlas Blog')
                ->logo(Schema::imageObject()->url(asset('images/logo.png'))))
            ->image($blog->image_url);

        return view('blog.blog-detail', [
            'blog' => $blog,
            'otherBlogs' => $otherBlogs,
            'schema' => $schema,
        ]);
    }
}
