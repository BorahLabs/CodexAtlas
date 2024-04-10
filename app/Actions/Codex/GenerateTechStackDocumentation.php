<?php

namespace App\Actions\Codex;

use App\Atlas\DependencyFiles;
use App\LLM\Contracts\Llm;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\Branch;
use App\Models\BranchDocument;
use App\Models\Repository;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class GenerateTechStackDocumentation
{
    use AsAction;

    public function handle(Repository $repository, Branch $branch): BranchDocument
    {
        $dependencyFiles = DependencyFiles::getDependencyFilesFromBranch($branch);
        $dependencyFile = $this->generateFileWithAllDependencies($dependencyFiles);

        /**
         * @var Llm
         */
        $llm = app(Llm::class);

        $completion = $llm->describeFile($repository->project, $dependencyFile, PromptRequestType::TECH_STACK);
        $dependencies = json_decode($completion->completion, true);
        $markdownTechStackDocument = $this->generateMarkdownTechStackDocument($dependencies);

        return $branch->branchDocuments()->updateOrCreate(
            ['path' => 'TechStackFile'],
            ['name' => 'TechStackFile', 'content' => $markdownTechStackDocument , 'json_docs' => $dependencies]
        );
    }

    private function generateFileWithAllDependencies(array $dependencyFiles): File
    {
        $content = '';

        foreach ($dependencyFiles as $dependencyFile) {
            $content .= $dependencyFile->name.":\n".$dependencyFile->contents."\n\n";
        }

        return new File(name: 'Dependency Files', contents: $content, path: '', downloadUrl: '', sha: '');
    }

    private function generateMarkdownTechStackDocument(array $dependencies): string
    {
        $markdown = '';
        foreach($dependencies as $key => $dependency) {
            $markdown .= '# '. $key."\n\n".$dependency."\n\n";
        }
        return $markdown;
    }
}
