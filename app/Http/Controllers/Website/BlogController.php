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
        $abortShow = true;
        if(auth()->user()){
            if(auth()->user()->emailIsFromCodex()){
                $abortShow = false;
            } else{
                $abortShow = ! $blog->is_visible;
            }
        } else{
            $abortShow = ! $blog->is_visible;
        }

        abort_if($abortShow, 404);

        $otherBlogs = Blog::query()->where('id', '!=', $blog->id)->inRandomOrder()->get()->take(3);
        
        return view('blog.blog-detail', [
            'blog' => $blog,
            'otherBlogs' => $otherBlogs,
        ]);
    }
}
