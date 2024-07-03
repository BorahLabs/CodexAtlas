<?php

use App\Models\BlogPost;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('homepage'));
});

// Home > Blog
Breadcrumbs::for('blog', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Blog', route('blog.index'));
});

// Home > Blog
Breadcrumbs::for('blogDetail', function (BreadcrumbTrail $trail, BlogPost $blog) {
    $trail->parent('blog');
    $trail->push($blog->title, route('blog.detail', $blog));
});
