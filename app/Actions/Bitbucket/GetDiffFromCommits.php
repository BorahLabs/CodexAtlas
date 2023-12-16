<?php

namespace App\Actions\Bitbucket;

use App\Actions\Bitbucket\Auth\GetAuthenticatedAccountBitbucketClient;
use App\Enums\FileChange;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use App\SourceCode\DTO\Diff;
use App\SourceCode\DTO\DiffItem;
use Bitbucket\ResultPager;
use Lorisleiva\Actions\Concerns\AsAction;

class GetDiffFromCommits
{
    use AsAction;

    public function handle(SourceCodeAccount $account, Repository $repository, array $commits): Diff
    {
        $client = GetAuthenticatedAccountBitbucketClient::make()->handle($account);
        $paginator = new ResultPager($client);
        $api = $client
            ->repositories()
            ->workspaces($repository->workspace)
            ->diffStat($repository->name);

        $diff = new Diff();
        foreach ($commits as $commitHash) {
            $diffs = $paginator->fetchAllLazy($api, 'download', [$commitHash]);
            foreach ($diffs as $rawDiff) {
                if (isset($rawDiff['old'])) {
                    $diff->add(new DiffItem(
                        path: $rawDiff['old']['path'],
                        change: FileChange::from($rawDiff['status']),
                    ));
                }

                if (isset($rawDiff['new'])) {
                    $diff->add(new DiffItem(
                        path: $rawDiff['new']['path'],
                        change: FileChange::from($rawDiff['status']),
                    ));
                }
            }
        }

        return $diff;
    }
}
