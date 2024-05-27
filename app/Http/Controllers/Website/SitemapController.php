<?php

namespace App\Http\Controllers\Website;

use App\Atlas\Guesser;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function __invoke(Request $request)
    {
        $sitemap = Sitemap::create();
        $sitemap->add(Url::create(route('homepage'))->setPriority(1)->setChangeFrequency('daily'));
        $cacheKey = 'codex-sitemap-v4';
        if (Cache::has($cacheKey)) {
            $sitemapContents = Cache::get($cacheKey);

            return response($sitemapContents)->header('Content-Type', 'text/xml');
        }

        foreach (Guesser::supportedLanguages() as $language) {
            $sitemap->add(Url::create(route('tools.code-documentation', ['language' => Str::slug($language->name())]))->setPriority(0.9)->setChangeFrequency('weekly'));
        }

        foreach (\App\CodeConverter\Tools\CodeConverterTool::all() as $tool) {
            $sitemap->add(Url::create($tool->url())->setPriority(0.9)->setChangeFrequency('weekly'));
        }

        $sitemap->add(Url::create(route('tools.readme-generator', absolute: false))->setPriority(0.9)->setChangeFrequency('weekly'));
        $sitemap->add(Url::create(route('tools.code-fixer'))->setPriority(0.9)->setChangeFrequency('weekly'));

        foreach ((new GuideController)->folders() as $folder) {
            foreach ($folder['children'] as $file) {
                if ($file->isComingSoon()) {
                    continue;
                }

                $sitemap->add(Url::create($file->url())->setPriority(0.8)->setChangeFrequency('weekly'));
            }
        }

        Cache::rememberForever($cacheKey, fn () => $sitemap->render());

        return $sitemap;
    }
}
