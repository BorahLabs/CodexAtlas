<?php

namespace App\Actions\Gitlab;

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

class HandleWebhook
{
    use AsAction;

    public function handle(Request $request, $uuid)
    {
        logger('entre en el post controlador para gitlab');
        logger($uuid);
        logger($request->toArray());
        // logger($request->toArray());
    }

    public function asController(Request $request, $uuid)
    {
        $this->handle($request, $uuid);

        return redirect()->route('dashboard');
    }
}
