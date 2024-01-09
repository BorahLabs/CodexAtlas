<?php

namespace App\Exceptions;

use App\Actions\Twist\SendMessageToTwistThread;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            SendMessageToTwistThread::dispatch(config('services.twist.bad_thread'), '💥 [UNCAUGHT ERROR] '.$e->getMessage().' on line '.$e->getLine().' in file '.$e->getFile());
        });
    }
}
