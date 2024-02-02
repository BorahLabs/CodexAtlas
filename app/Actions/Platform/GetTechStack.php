<?php

namespace App\Actions\Platform;

use App\Atlas\DependencyFiles;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Branch;
use App\Models\Repository;
use App\SourceCode\Contracts\SourceCodeProvider;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Lorisleiva\Actions\Concerns\AsAction;
use Psy\Util\Str;

class GetTechStack
{
    use AsAction;

    public string $commandSignature = 'get:tech-stack';

    public function handle(Repository $repository, Branch $branch): ?File
    {
        $provider = $repository->sourceCodeAccount->getProvider();
        $repositoryName = $repository->nameDto();
        $branchName = $branch->name;

        $dependencyFiles = $this->getDependencyFiles($provider, $repositoryName, $branchName);
        $dependencyFile = $this->generateFileWithAllDependencies($dependencyFiles);
        /**
         * @var Llm
        */
        $llm = app(Llm::class);
        $techStack = $branch->branchDocuments()->where('path', 'TechStackFile')->first();

        $file = null;
        if($techStack) {
            $key = sha1($techStack->content);
            $file = Cache::get($key);
        }

        if (is_null($file)) {
                $completion = $llm->describeFile($repository->project, $dependencyFile, PromptRequestType::TECH_STACK);
                $branchDocument = $branch->branchDocuments()->updateOrCreate(
                    ['path' => 'TechStackFile'],
                    ['name' => 'TechStackFile', 'content' => $completion->completion]
                );
                $key = sha1($branchDocument->content);
                $file = new File('TechStackFile', 'TechStackFile', '', '', $completion->completion);
                Cache::put($key, $file, now()->addWeek(1));
        }

        return $file;
    }

    private function getDependencyFiles(SourceCodeProvider $provider, RepositoryName $repositoryName, string $branchName) : array
    {
        $filesAndFolders = $provider->files(
            repository: $repositoryName,
            branch: new DTOBranch(name: $branchName),
            path: null,
        );
        $folder = Folder::makeWithFiles($filesAndFolders, $repositoryName->name, $repositoryName->username, sha1($repositoryName->fullName));
        $dependencyFileNames = DependencyFiles::getFolderDependencyFiles($folder);

        $dependencyFiles = [];

        foreach($dependencyFileNames as $dependencyFileName) {
            $dependencyFiles[] = $provider->file($repositoryName, new DTOBranch(name:$branchName), $dependencyFileName);
        }

        return $dependencyFiles;
    }

    private function generateFileWithAllDependencies(array $dependencyFiles): File
    {
        $content = '';

        foreach ($dependencyFiles as $dependencyFile) {
            $content .= $dependencyFile->name . ":\n" . $dependencyFile->contents . "\n\n";
        }

        return new File(name: 'Dependency Files', contents: $content, path: '', downloadUrl: '', sha: '');
    }

}
