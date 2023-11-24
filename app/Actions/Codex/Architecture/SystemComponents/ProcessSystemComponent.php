<?php

namespace App\Actions\Codex\Architecture\SystemComponents;

use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\Models\Branch;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class ProcessSystemComponent
{
    use AsAction;

    public int $jobTries = 5;

    public int $jobMaxExceptions = 3;

    public int $jobBackoff = 180;

    public function handle(Branch $branch, File $file, int $order)
    {
        logger()->debug('[Codex] Processing file '.$file->path.' branch '.$branch->id);
        $repository = $branch->repository;
        $sourceCodeAccount = $repository->sourceCodeAccount;
        $project = $repository->project;
        $provider = $sourceCodeAccount->getProvider();
        $repoName = $repository->nameDto();
        try {
            $file = $provider->file($repoName, $branch->dto(), $file->path);
            $llm = app(Llm::class);
            $explanation = $llm->describeFile($project, $file);

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
                'branch' => $branch->id,
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
