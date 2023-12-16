<?php

namespace App\Actions\Gitlab;

use App\Models\SourceCodeAccount;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class VerifyWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, Request $request)
    {
        abort_unless($request->hasHeader('x-gitlab-token'), 422, 'The request does not have a signature header.');
        $signature = $request->header('x-gitlab-token');
        $secret = $account->webhook_secret;
        abort_if($secret !== $signature, 403, 'The webhook signature does not match.');
    }
}
