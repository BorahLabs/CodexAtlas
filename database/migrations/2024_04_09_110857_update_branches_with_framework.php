<?php

use App\Actions\Codex\Architecture\FilterFilesByFramework;
use App\Models\Branch;
use App\SourceCode\DTO\Branch as DTOBranch;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Branch::query()->whereNull('framework_name')->each(function (Branch $branch) {

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
                return true;
            }

            [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);
            $branch->update(['framework_name' => $framework->name()]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
