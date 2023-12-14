<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\GetToken;
use App\Actions\Github\GetInstallationToken;
use App\Enums\SourceCodeProvider;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use App\Services\GetUuidFromJson;
use GrahamCampbell\GitHub\Facades\GitHub;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleBitbucketWebhook
{
    use AsAction;

    public function handle(Request $request)
    {
        logger('entre en el post controlador');
        logger($request->toArray());
        // logger($request->toArray());
    }

    public function asController(Request $request)
    {
        $this->handle($request);

        return redirect()->route('dashboard');
    }
}
