<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.blog-list', [
            'blogs' => BlogPost::query()->get(),
        ]);
    }

    public function detail(BlogPost $blog)
    {
        if (! auth()->user()?->emailIsFromCodex()) {
            abort_if(! $blog->is_visible, 404);
        }

        $blogIds = collect($blog->related_blogs);

        $otherBlogs = collect([]);

        $blogIds->each(function($id) use (&$otherBlogs) {
            $blog = BlogPost::query()->find($id);

            if($blog){
                $otherBlogs->push($blog);
            }
        });

        return view('blog.blog-detail', [
            'blog' => $blog,
            'otherBlogs' => $otherBlogs,
        ]);
    }
}
