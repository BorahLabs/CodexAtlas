<?php

namespace App\Actions\Codex;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Atlas\DependencyFiles;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Branch;
use App\Models\BranchDocument;
use App\Models\Repository;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\File;
use App\SourceCode\DTO\Folder;

class GenerateTechStackDocumentation {

    use AsAction;

    public function handle(Repository $repository, Branch $branch): BranchDocument
    {
        $dependencyFiles = $this->getDependencyFiles($repository, $branch);
        $dependencyFile = $this->generateFileWithAllDependencies($dependencyFiles);

        /**
         * @var Llm
        */
        $llm = app(Llm::class);

        $completion = $llm->describeFile($repository->project, $dependencyFile, PromptRequestType::TECH_STACK);
        return $branch->branchDocuments()->updateOrCreate(
            ['path' => 'TechStackFile'],
            ['name' => 'TechStackFile', 'content' => $completion->completion]
        );
    }

    private function getDependencyFiles(Repository $repository, Branch $branch) : array
    {
        $provider = $repository->sourceCodeAccount->getProvider();
        $repositoryName = $repository->nameDto();
        $branchName = $branch->name;

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
