<?php

use App\Actions\Codex\Architecture\FilterFilesByFramework;
use App\Models\Branch;
use App\SourceCode\DTO\Branch as DTOBranch;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Branch::query()->whereNull('framework_name')->each(function(Branch $branch) {

            $repository = $branch->repository;
            $sourceCodeAccount = $repository->sourceCodeAccount;
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
