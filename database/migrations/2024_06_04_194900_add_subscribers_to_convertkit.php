<?php

use App\Actions\Convertkit\AddSubcriberToWelcomeSequence;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        if (! app()->environment('testing')) {
            User::query()
            ->whereNotNull('email_verified_at')
            ->each(function (User $user) {
                AddSubcriberToWelcomeSequence::dispatch($user);
            });
        }
    }
};
