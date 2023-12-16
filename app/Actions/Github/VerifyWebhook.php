<?php

namespace App\Actions\Github;

use App\Models\SourceCodeAccount;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, Request $request)
    {
        abort_unless($request->hasHeader('x-hub-signature-256'), 422, 'The request does not have a signature header.');
        $signature = $request->header('x-hub-signature-256');
        $secret = $account->webhook_secret;
        $calculatedSignature = 'sha256=' . hash_hmac('sha256', $request->getContent(), $secret);
        if (!hash_equals($calculatedSignature, $signature)) {
            logger('The webhook signature does not match.');
            abort(403, 'The webhook signature does not match.');
        }
    }
}
