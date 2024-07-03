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

        $lines = explode("\n", $blog->markdown_content);
        $titles = collect();
        $currentMainTitle = null;

        foreach ($lines as $line) {
            // Verify if the line is ## (h2)
            if (preg_match('/^\s*##\s(?!#)(.+)/', $line, $matches)) {
                $currentMainTitle = ['title' => trim($matches[1]), 'subtitles' => collect()];
                $titles->push($currentMainTitle);
            }
            // Verify if the line is ### (h3)
            elseif (preg_match('/^\s*###\s(.+)/', $line, $matches)) {
                if ($currentMainTitle) {
                    $currentMainTitle['subtitles']->push(trim($matches[1]));
                    $titles->pop();
                    $titles->push($currentMainTitle);
                }
            }
        }

        $sections = $titles->map(function ($title) {
            return [
                'title' => $title['title'],
                'subtitles' => $title['subtitles']->toArray()
            ];
        });

        return view('blog.blog-detail', [
            'blog' => $blog,
            'otherBlogs' => $otherBlogs,
            'sections' => $sections,
        ]);
    }
}
