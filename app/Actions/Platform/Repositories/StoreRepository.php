<?php

namespace App\Actions\Platform\Repositories;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Models\Project;
use App\Models\Repository;
use App\SourceCode\Contracts\RegistersWebhook;
use App\SourceCode\DTO\Branch as DTOBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Gate;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreRepository
{
    use AsAction;

    public function handle(Project $project, string $sourceAccountId, string $name): Repository|RedirectResponse
    {
        dd($name);
        $sourceCodeAccount = $project->team->sourceCodeAccounts()->findOrFail($sourceAccountId);
        try {
            $repo = $sourceCodeAccount->provider->repositoryName($name);
        } catch (\Exception $e) {
            logger($e);

            return redirect()->back()->withErrors([
                'name' => 'The repository name '.$name.' is invalid. Please, make sure it follows the format <username>/<repository-name>. If it belongs to a workspace, use <workspace>/<repository-name>.',
            ]);
        }

        try {
            $repository = $sourceCodeAccount->getProvider()->repository($repo);
        } catch (\Exception $e) {
            logger($e);

            LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Warning, 'User tried to add repository '.$repo->fullName . ' and was not found', [
                'project' => $project->id,
                'project_name' => $project->name,
            ]);

            return redirect()->back()->withErrors([
                'name' => 'The repository '.$repo->fullName.' could not be found. Please, make sure it belongs to the selected account.',
            ]);
        }

        $exists = $project->repositories()->where('name', $repo->name)->where('username', $repo->username)->first();
        $repository = $exists ?? $project->repositories()->create([
            'source_code_account_id' => $sourceCodeAccount->id,
            'project_id' => $project->id,
            'username' => $repo->username,
            'name' => $repo->name,
            'workspace' => $repo->workspace ?? null,
        ]);

        if ($sourceCodeAccount->getProvider() instanceof RegistersWebhook) {
            try {
                retry(3, fn () => $sourceCodeAccount->getProvider()->registerWebhook($repo), 1000);
            } catch (\Exception $e) {
                LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Warning, 'Error registering webhook to '.$repo->fullName, [
                    'repository' => $repository->id,
                    'error' => $e->getMessage(),
                ]);
                logger('Could not register webhook for '.$repo->fullName, [
                    'message' => $e->getMessage(),
                ]);
            }
        }

        if ($repository->branches->isEmpty()) {
            $branches = $sourceCodeAccount->getProvider()->branches($repo);
            $whitelist = ['main', 'master', 'production', 'prod', 'release', 'dev', 'develop', 'staging'];
            /**
             * @var \App\Enums\SubscriptionType $subscriptionType
             */
            $subscriptionType = $project->team->subscriptionType();
            collect($branches)
                ->filter(fn (DTOBranch $branch) => in_array($branch->name, $whitelist))
                ->values()
                ->when(! is_null($subscriptionType->maxBranchesPerRepository()), fn (Collection $branches) => $branches->take($subscriptionType->maxBranchesPerRepository()))
                ->each(fn (DTOBranch $branch) => $repository->branches()->create([
                    'name' => $branch->name,
                ]));

        }

        return $repository;
    }

    public function asController(Project $project, Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'source_code_account_id' => 'required|exists:source_code_accounts,id',
            'name' => "required|string|max:255|regex:/([\w\-_]+)\/([\w\-_]+)/",
        ]);

        Gate::authorize('create-repository');

        $repository = $this->handle($project, $validated['source_code_account_id'], $validated['name']);

        LogUserPerformedAction::dispatch(\App\Enums\Platform::Codex, \App\Enums\NotificationType::Success, 'User added repository '.$validated['name'], [
            'project' => $project->id,
        ]);

        return redirect()->route('projects.show', ['project' => $project]);
    }
}
