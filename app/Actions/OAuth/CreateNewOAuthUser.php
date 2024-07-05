<?php

namespace App\Actions\OAuth;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\Team;
use App\Models\User;
use BorahLabs\AwsMarketplaceSaas\Facades\AwsMarketplaceSaas;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Lorisleiva\Actions\Concerns\AsAction;

class CreateNewOAuthUser
{
    use AsAction;

    /**
     * Create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function handle(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'external_id' => ['required', 'string', 'max:255'],
            'external_auth' => ['required', 'string', 'max:255'],
        ])->validate();

        return DB::transaction(function () use ($input) {
            return tap(User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'email_verified_at' => now(),
            ]), function (User $user) use ($input) {
                $this->createExternalAuth($user, $input);
                $this->createTeam($user);
                // LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Info, 'New user', [
                //     'email' => $user->email,
                //     'name' => $user->name,
                // ]);
                // AwsMarketplaceSaas::afterUserRegistered($user);
            });
        });
    }

    /**
     * Create a personal team for the user.
     */
    protected function createTeam(User $user): void
    {
        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }

    /**
     * Create an external auth account record the user.
     */
    protected function createExternalAuth(User $user, array $input): void
    {
        $user->externalAuthAccounts()->create([
            'external_id' => $input['external_id'],
            'external_auth' => $input['external_auth'],
        ]);

        $user->ownedTeams()->save(Team::forceCreate([
            'user_id' => $user->id,
            'name' => explode(' ', $user->name, 2)[0]."'s Team",
            'personal_team' => true,
        ]));
    }
}
