<?php

namespace App\Actions\Github;

use App\Actions\Codex\UpdateDocumentationFromDiff;
use App\Enums\FileChange;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Diff;
use App\SourceCode\DTO\DiffItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, array $payload, Request $request): mixed
    {
        switch ($request->header('x-github-event')) {
            case 'ping':
                return response()->json([
                    'message' => 'pong',
                ]);
            case 'push':
                return $this->handlePush($account, $payload);
        }
    }

    private function handlePush(SourceCodeAccount $account, array $payload): void
    {
        $repositoryName = $account->provider->repositoryName(data_get($payload, 'repository.full_name'));
        $repository = $account
            ->repositories()
            ->where('name', $repositoryName->name)
            ->where('username', $repositoryName->username)
            ->when($repositoryName->workspace, fn (Builder $query) => $query->where('workspace', $repositoryName->workspace))
            ->when(! $repositoryName->workspace, fn (Builder $query) => $query->whereNull('workspace'))
            ->firstOrFail();

        $branchName = str_replace('refs/heads/', '', data_get($payload, 'ref'));
        $branch = $repository->branches()->where('name', $branchName)->first();
        if (is_null($branch)) {
            // If we are not using that branch, we can ignore it
            return;
        }

        $diff = new Diff();
        $commits = array_reverse(data_get($payload, 'commits', []));
        foreach ($commits as $commit) {
            foreach (data_get($commit, 'added', []) as $file) {
                $diff->add(new DiffItem($file, FileChange::Added));
            }

            foreach (data_get($commit, 'modified', []) as $file) {
                $diff->add(new DiffItem($file, FileChange::Modified));
            }

            foreach (data_get($commit, 'removed', []) as $file) {
                $diff->add(new DiffItem($file, FileChange::Removed));
            }
        }

        UpdateDocumentationFromDiff::dispatch($branch, $diff);
    }
}
