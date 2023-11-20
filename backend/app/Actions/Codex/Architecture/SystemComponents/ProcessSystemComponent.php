<?php

namespace App\Actions\Codex\Architecture\SystemComponents;

use App\Actions\AsAction;
use App\Actions\Github\GetFile;
use App\Actions\Openai\RunUntilFinished;
use App\Enums\DocumentationSection;
use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\Models\Branch;
use App\Prompts\AutoDoc\SystemComponentsDescribeFile;
use App\SourceCode\DTO\Branch as DTOBranch;
use App\SourceCode\DTO\File;
use OpenAI;

class ProcessSystemComponent
{
    use AsAction;

    public int $jobTries = 5;

    public int $jobMaxExceptions = 3;

    public int $jobBackoff = 180;

    public function handle(Branch $branch, File $file, int $order)
    {
        $repository = $branch->repository;
        $sourceCodeAccount = $repository->sourceCodeAccount;
        $project = $repository->project;
        $provider = $sourceCodeAccount->getProvider();
        $repoName = $repository->nameDto();
        try {
            $file = $provider->file($repoName, $branch->dto(), $file->path);
            $llm = app(Llm::class);
            $explanation = $llm->describeFile($project, $file);
            dd($explanation);

            $branch->systemComponents()->updateOrCreate([
                'path' => $file->path,
            ], [
                'order' => $order++,
                'sha' => $file->sha,
                'path' => $file->path,
                'file_contents' => $file->contents(),
                'markdown_docs' => $this->formatExplanation($explanation, $file->path),
                'status' => SystemComponentStatus::Generated,
            ]);
        } catch (\Exception $e) {
            logger()->error($e->getMessage(), [
                'file' => $file->path,
            ]);

            throw $e;
        }
    }

    private function formatExplanation(string $explanation, string $path)
    {
        $lines = explode("\n", $explanation);
        $formatted = [];
        foreach ($lines as $line) {
            if (str_starts_with($line, '# ')) {
                continue;
            }

            $formatted[] = $line;
        }

        return '# '.basename($path)."\n\n".implode("\n", $formatted);
    }
}
