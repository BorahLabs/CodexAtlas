<?php

namespace App\Console\Commands\Maintenance;

use App\Actions\Codex\Architecture\FilterFilesByFramework;
use App\Models\Branch;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use Exception;
use Illuminate\Console\Command;

class UpdateFrameworkOnBranches extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'maintenance:update-framework-on-branches';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        Branch::query()->whereNull('framework_name')->each(function (Branch $branch) {
            $this->info('Processing branch '.$branch->id);
            try {
                $repository = $branch->repository;
                $sourceCodeAccount = $repository->sourceCodeAccount;
                if (! $sourceCodeAccount) {
                    return true;
                }
                /**
                 * @var SourceCodeProvider
                 */
                $provider = $sourceCodeAccount->getProvider();
                $repoName = $repository->nameDto();
                $filesAndFolders = $provider->files(
                    repository: $repoName,
                    branch: new DTOBranch(name: $branch->name),
                    path: null,
                );
            } catch (Exception $e) {
                $this->warn('An error occurred while fetching files for branch '.$branch->id);
                $this->warn($e->getMessage());

                return true;
            }

            [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);
            $branch->update(['framework_name' => $framework->name()]);
        });
    }
}
