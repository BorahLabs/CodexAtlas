<?php

namespace App\Actions\Platform\Repositories;

use App\Actions\Twist\SendMessageToTwistThread;
use App\Models\Project;
use App\Models\Repository;
use App\SourceCode\Contracts\RegistersWebhook;
use App\SourceCode\DTO\Branch as DTOBranch;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreRepository
{
    use AsAction;

    public function handle(Project $project, string $sourceAccountId, string $name): Repository|RedirectResponse
    {
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
                logger('Could not register webhook for '.$repo->fullName, [
                    'message' => $e->getMessage(),
                ]);
            }
        }

        if ($repository->branches->isEmpty()) {
            $branches = $sourceCodeAccount->getProvider()->branches($repo);
            $whitelist = ['main', 'master', 'production', 'prod', 'release', 'dev', 'develop', 'staging'];
            collect($branches)
                ->filter(fn ($branch) => in_array($branch->name, $whitelist))
                ->values()
                ->each(fn (DTOBranch $branch) => $repository->branches()->create([
                    'name' => $branch->name,
                ]));
        }

        SendMessageToTwistThread::dispatch(config('services.twist.nice_thread'), '🌱 New repository added! ' . $repo->fullName . ' in project ' . $project->name);

        return $repository;
    }

    public function asController(Project $project, Request $request)
    {
        $validated = $request->validate([
            'source_code_account_id' => 'required|exists:source_code_accounts,id',
            'name' => "required|string|max:255|regex:/([\w\-_]+)\/([\w\-_]+)/",
        ]);

        $repository = $this->handle($project, $validated['source_code_account_id'], $validated['name']);

        return redirect()->route('projects.show', ['project' => $project]);
    }
}
