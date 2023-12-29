<?php

namespace App\Actions\Gitlab;

use App\Actions\Codex\UpdateDocumentationFromDiff;
use App\Enums\FileChange;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Diff;
use App\SourceCode\DTO\DiffItem;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, array $payload): void
    {
        if (data_get($payload, 'object_kind') === 'push') {
            $this->handlePush($account, $payload);
        }
    }

    private function handlePush(SourceCodeAccount $account, array $payload): void
    {
        $repositoryName = $account->provider->repositoryName(data_get($payload, 'project.path_with_namespace'));
        $repository = $account
            ->repositories()
            ->where('name', $repositoryName->name)
            ->where('username', $repositoryName->username)
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
