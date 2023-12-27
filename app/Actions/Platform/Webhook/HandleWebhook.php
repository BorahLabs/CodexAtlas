<?php

namespace App\Actions\Platform\Webhook;

use App\Models\SourceCodeAccount;
use App\SourceCode\Contracts\HandlesWebhook;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $sourceCodeAccount, Request $request)
    {
        $provider = $sourceCodeAccount->getProvider();
        if ($provider instanceof HandlesWebhook) {
            $provider->verifyIncomingWebhook($request);

            return $provider->handleIncomingWebhook($request->all(), $request);
        }

        abort(422, 'The provider does not handle webhooks.');
    }

    public function asController(SourceCodeAccount $sourceCodeAccount, Request $request)
    {
        $response = $this->handle($sourceCodeAccount, $request);

        return $response ?? response()->json([
            'success' => true,
        ]);
    }
}
