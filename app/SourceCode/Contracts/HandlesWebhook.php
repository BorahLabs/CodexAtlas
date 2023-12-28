<?php

namespace App\SourceCode\Contracts;

use Illuminate\Http\Request;

interface HandlesWebhook
{
    public function verifyIncomingWebhook(Request $request);

    public function handleIncomingWebhook(array $payload, Request $request);
}
