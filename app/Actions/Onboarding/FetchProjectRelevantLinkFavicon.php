<?php

namespace App\Actions\Onboarding;

use App\Models\ProjectRelevantLink;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Lorisleiva\Actions\Concerns\AsAction;

class FetchProjectRelevantLinkFavicon
{
    use AsAction;

    public function handle(ProjectRelevantLink $link)
    {
        $domain = parse_url($link->url, PHP_URL_HOST);
        $faviconUrl = "https://t1.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=http://$domain&size=64";
        try {
            $response = Http::get($faviconUrl)->throw();
            $path = 'favicons/'.str($domain)->slug().time().'.png';
            Storage::put($path, $response->body(), 'public');
            $link->updateQuietly(['favicon_path' => $path]);
        } catch (\Exception $e) {
            return;
        }
    }
}
