<?php

namespace App\Actions\Platform\Repositories;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreRepository
{
    use AsAction;

    public function handle(Project $project, string $sourceAccountId, string $name): Repository
    {
        $sourceCodeAccount = $project->team->sourceCodeAccounts()->findOrFail($sourceAccountId);
        [$username, $name] = explode('/', $name);
        $repo = new RepositoryName($username, $name);
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
        ]);

        if ($repository->branches->isEmpty()) {
            $branches = $sourceCodeAccount->getProvider()->branches($repo);
            $whitelist = ['main', 'master', 'production', 'release', 'dev', 'develop', 'staging'];
            collect($branches)
                ->filter(fn ($branch) => in_array($branch->name, $whitelist))
                ->values()
                ->each(fn (DTOBranch $branch) => $repository->branches()->create([
                    'name' => $branch->name,
                ]));
        }

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
