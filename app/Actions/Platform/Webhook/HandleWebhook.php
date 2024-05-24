<?php

namespace App\Actions\Platform\Webhook;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\SourceCodeAccount;
use App\SourceCode\Contracts\HandlesWebhook;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $sourceCodeAccount, Request $request): mixed
    {
        $provider = $sourceCodeAccount->getProvider();
        if ($provider instanceof HandlesWebhook) {
            $provider->verifyIncomingWebhook($request);
            LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Info, 'Processing webhook...');
            return $provider->handleIncomingWebhook($request->all(), $request);
        }

        abort(422, 'The provider does not handle webhooks.');
    }

    public function asController(SourceCodeAccount $sourceCodeAccount, Request $request): mixed
    {
        $response = $this->handle($sourceCodeAccount, $request);

        return $response ?? response()->json([
            'success' => true,
        ]);
    }
}
