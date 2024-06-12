<?php

use App\Models\Blog;
use App\Models\BlogPost;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

test('Empty blog post shows the empty state', function () {
    $response = $this->get('/blog');
    $response->assertStatus(200);

    $emptyImage = '<img class="w-96" src="' . asset('casper-assets/http-code/planet-cropped.png') . '"';
    $response->assertSee($emptyImage, false);
});

test('Blog post does not show no active posts and they are not accessible', function () {
    $blogNoActive = BlogPost::factory()->active(false)->publishedAt(now())->create();

    $this->get(route('blog.detail', $blogNoActive))
        ->assertStatus(404);
});

test('Blog does not show future posts and they are not accessible', function () {
    $blogNoPublished = BlogPost::factory()->active(true)->publishedAt(now()->addDay())->create();

    $this->get(route('blog.detail', $blogNoPublished))
        ->assertStatus(404);
});

test('Future / inactive blog posts are accessible if I an logged with an email from codex', function () {
    $user = User::query()->where('email', 'admin@codexatlas.app')->firstOrFail();

    $this->actingAs($user);

    $blogNoPublished = BlogPost::factory()->active(true)->publishedAt(now()->addDay())->create();

    $this
        ->get(route('blog.detail', ['blog' => $blogNoPublished]))
        ->assertStatus(200);

    $blogNoActive = BlogPost::factory()->active(false)->publishedAt(now())->create();

    $this
        ->get(route('blog.detail', ['blog' => $blogNoActive]))
        ->assertStatus(200);
});

test('Blog post can be accessed if they are published, and they return a 200', function() {
    $blog = BlogPost::factory()->active(true)->publishedAt(now())->create();

    $this
        ->get(route('blog.detail', ['blog' => $blog]))
        ->assertStatus(200);
});
