<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

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
        if (! auth()->user()?->emailIsFromCodex()) {
            abort_if(! $blog->is_visible, 404);
        }

        $blogIds = collect($blog->related_blogs);

        $otherBlogs = BlogPost::query()->whereIn('id', $blogIds)->get();

        return view('blog.blog-detail', [
            'blog' => $blog,
            'otherBlogs' => $otherBlogs,
        ]);
    }
}
