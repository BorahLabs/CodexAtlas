<?php

namespace App\Actions\Bitbucket;

use App\Actions\Codex\UpdateDocumentationFromDiff;
use App\Models\SourceCodeAccount;
use Lorisleiva\Actions\Concerns\AsAction;

class HandleWebhook
{
    use AsAction;

    public function handle(SourceCodeAccount $account, array $payload)
    {
        if (isset($payload['push']['changes'])) {
            $this->handlePush($account, $payload);
        }
    }

    private function handlePush(SourceCodeAccount $account, array $payload)
    {
        $changes = data_get($payload, 'push.changes', []);
        $repositoryName = $account->provider->repositoryName(data_get($payload, 'repository.full_name'));
        $repository = $account
            ->repositories()
            ->where('name', $repositoryName->name)
            ->where('username', $repositoryName->username)
            ->when($repositoryName->workspace, fn ($query) => $query->where('workspace', $repositoryName->workspace))
            ->when(!$repositoryName->workspace, fn ($query) => $query->whereNull('workspace'))
            ->firstOrFail();

        $branches = [];
        foreach ($changes as $change) {
            $branch = $repository->branches()->where('name', $change['new']['name'])->first();
            if (is_null($branch)) {
                // If we are not using that branch, we can ignore it
                continue;
            }

            if (!isset($branches[$branch->id])) {
                $branches[$branch->id] = [
                    'branch' => $branch,
                    'commits' => [],
                ];
            }

            foreach ($change['commits'] as $commit) {
                $branches[$branch->id]['commits'][] = $commit['hash'];
            }
        }

        foreach ($branches as $data) {
            // since commits are ordered from newest to oldest, we need to reverse them
            $branchDiff = GetDiffFromCommits::make()->handle($account, $repository, array_reverse($data['commits']));
            UpdateDocumentationFromDiff::dispatch($data['branch'], $branchDiff);
        }
    }
}
