<?php

namespace App\Actions\Platform\SourceCodeAccounts;

use App\Enums\SourceCodeProvider;
use App\Exceptions\PersonalAccessTokenIsNotValidException;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use App\SourceCode\Contracts\AccountInfoProvider;
use App\SourceCode\Contracts\SourceCodeProvider as ContractsSourceCodeProvider;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreAccountPersonalAccessToken
{
    use AsAction;

    public function handle(Team $team, SourceCodeProvider $sourceCodeProvider, string $username, string $token)
    {
        /**
         * @var AccountInfoProvider|ContractsSourceCodeProvider $provider
         */
        $provider = $sourceCodeProvider->provider();

        abort_unless($provider instanceof AccountInfoProvider, 500, 'The provider is not a valid provider.');

        $credentials = new SourceCodeAccount([
            'team_id' => $team->id,
            'provider' => $sourceCodeProvider->value,
            'name' => $username,
            'external_id' => '',
            'access_token' => $token,
        ]);

        try {
            $account = $provider->withCredentials($credentials)->account();
        } catch (\Bitbucket\Exception\RuntimeException $e) {
            throw new PersonalAccessTokenIsNotValidException();
        } catch (\Gitlab\Exception\RuntimeException $e) {
            throw new PersonalAccessTokenIsNotValidException();
        } catch (\Exception $e) {
            throw $e;
        }

        $credentials->external_id = $account->id;
        $credentials->save();
    }

    public function asController(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required|string|max:255',
            'pat' => 'required|string|max:255',
            'provider' => 'required|in:'.implode(',', [SourceCodeProvider::GitLab->value, SourceCodeProvider::Bitbucket->value]),
        ]);

        $provider = SourceCodeProvider::from($validated['provider']);
        try {
            $this->handle($request->user()->currentTeam, $provider, $validated['username'], $validated['pat']);
        } catch (PersonalAccessTokenIsNotValidException $e) {
            return redirect()->back()->withErrors([
                'pat' => 'The provided personal access token is not valid.',
            ])->with('provider', $provider->value);
        }

        return redirect()->back();
    }
}
