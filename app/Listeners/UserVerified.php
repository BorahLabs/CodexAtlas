<?php

namespace App\Listeners;

use App\Actions\Convertkit\AddSubcriberToWelcomeSequence;
use App\Models\User;

class UserVerified
{
    public function handle(object $event): void
    {
        AddSubcriberToWelcomeSequence::dispatch($event->user);
    }
}
