<?php

namespace App\Listeners;

use App\Actions\Twist\SendMessageToTwistThread;

class UserRegistered
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(object $event): void
    {
        SendMessageToTwistThread::dispatch(config('services.twist.nice_thread'), '🎉 New user registered! '.$event->user->email);
    }
}
