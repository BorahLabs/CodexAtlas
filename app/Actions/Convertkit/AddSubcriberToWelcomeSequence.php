<?php

namespace App\Actions\Convertkit;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\User;
use Lorisleiva\Actions\Concerns\AsAction;

class AddSubcriberToWelcomeSequence
{
    use AsAction;

    public string $commandSignature = 'convertkit:add-subscribers';

    public function handle(User $user): void
    {
        if (! config('services.convertkit.key')) {
            return;
        }

        $api = new \ConvertKit_API\ConvertKit_API(config('services.convertkit.key'), config('services.convertkit.secret'));
        try {
            $api->add_subscriber_to_sequence(config('services.convertkit.sequences.welcome'), $user->email, $user->name, [], [
                config('services.convertkit.tags.onboarding'),
            ]);
            LogUserPerformedAction::dispatch(
                \App\Enums\Platform::Codex,
                \App\Enums\NotificationType::Success,
                'User verified email and was added to ConvertKit',
                [
                    'email' => $user->email,
                ],
            );
        } catch (\Exception $e) {
            logger()->error($e);
            LogUserPerformedAction::dispatch(
                \App\Enums\Platform::Codex,
                \App\Enums\NotificationType::Error,
                'Could not add user to ConvertKit',
                [
                    'email' => $user->email,
                    'error' => $e->getMessage(),
                ],
            );
        }
    }

    public function asCommand(): void
    {
        User::query()
            ->whereNotNull('email_verified_at')
            ->each(function (User $user) {
                AddSubcriberToWelcomeSequence::dispatch($user);
            });
    }
}
