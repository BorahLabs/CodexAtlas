<?php

namespace App\SourceCode\Contracts;

use Illuminate\Http\Request;

interface HandlesWebhook
{
    public function verifyIncomingWebhook(Request $request): mixed;

    public function handleIncomingWebhook(array $payload, Request $request): mixed;
}
