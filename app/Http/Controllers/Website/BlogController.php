<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        return view('blog.blog-list', [
            'blogs' => Blog::query()->get(),
        ]);
    }

    public function detail(Blog $blog)
    {
        $otherBlogs = Blog::query()->where('id', '!=', $blog->id)->inRandomOrder()->get()->take(3);
        
        return view('blog.blog-detail', [
            'blog' => $blog,
            'otherBlogs' => $otherBlogs,
        ]);
    }
}
