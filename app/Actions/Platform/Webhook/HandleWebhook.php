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
            $provider->handleIncomingWebhook($request->all());
        } else {
            abort(422, 'The provider does not handle webhooks.');
        }
    }

    public function asController(SourceCodeAccount $sourceCodeAccount, Request $request)
    {
        $this->handle($sourceCodeAccount, $request);
    }
}
