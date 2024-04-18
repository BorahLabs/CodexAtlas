<?php

namespace App\Http\Controllers\Website;

use App\Atlas\Guesser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Sitemap\SitemapGenerator;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke(Request $request)
    {
        $sitemap = SitemapGenerator::create(config('app.url'))->getSitemap();

        $sitemap->add(Url::create(route('homepage', absolute: false))->setPriority(1.0));
        foreach (Guesser::supportedLanguages() as $language) {
            $sitemap->add(Url::create(route('tools.code-documentation', ['language' => Str::slug($language->name())], absolute: false))->setPriority(0.9)->setChangeFrequency('weekly'));
        }

        foreach ((new GuideController)->folders() as $folder) {
            foreach ($folder['children'] as $file) {
                $sitemap->add(Url::create($file->url(absolute: false))->setPriority(0.8)->setChangeFrequency('weekly'));
            }
        }

        return $sitemap;
    }
}
