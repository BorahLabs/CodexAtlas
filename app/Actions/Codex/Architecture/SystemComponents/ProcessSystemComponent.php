<?php

namespace App\Actions\Codex\Architecture\SystemComponents;

use App\Actions\Twist\SendMessageToTwistThread;
use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\LLM\DTO\CompletionResponse;
use App\LLM\OpenAI;
use App\Models\Branch;
use App\Models\ProcessingLogEntry;
use App\Models\SystemComponent;
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
        $branches = $repository->branches;
        $team = $project->team;
        $provider = $sourceCodeAccount->getProvider();
        $repoName = $repository->nameDto();

        try {
            $file = $provider->file($repoName, $branch->dto(), $file->path);
            $existingFile = SystemComponent::where('path', $file->path)
                ->whereIn('branch_id', $branches->pluck('id'))
                ->where('status', SystemComponentStatus::Generated)
                ->where('sha', $file->sha)
                ->first();
            /**
             * @var Llm
             */
            $llm = app(Llm::class);
            if ($llm instanceof OpenAI) {
                $llm->usingApiKey($team->openai_key);
            }

            if ($existingFile) {
                $completion = new CompletionResponse(
                    completion: $existingFile->markdown_docs,
                    processingTimeMilliseconds: 0,
                    inputTokens: 0,
                    outputTokens: 0,
                    totalTokens: 0,
                );
            } else {
                $completion = $llm->describeFile($project, $file);
            }

            $branch->systemComponents()->updateOrCreate([
                'path' => $file->path,
            ], [
                'order' => $order,
                'sha' => $file->sha,
                'path' => $file->path,
                'file_contents' => $team->stores_code ? $file->contents() : null,
                'markdown_docs' => $this->formatExplanation($completion->completion, $file->path),
                'status' => SystemComponentStatus::Generated,
            ]);

            ProcessingLogEntry::write($branch, $file->path, class_basename($llm), $llm->modelName(), $completion);
        } catch (\App\Exceptions\ExceededProviderRateLimit $e) {
            logger($e);
            SendMessageToTwistThread::dispatch(config('services.twist.bad_thread'), '🤬 Exceeded rate limit for '.$provider->name().' on file '.$file->path.' on branch '.$branch->id);
            ProcessSystemComponent::dispatch($branch, $file, $order)
                ->delay($e->retryInSeconds + 10);
        } catch (\Exception $e) {
            SendMessageToTwistThread::dispatch(config('services.twist.bad_thread'), '🚨 [ERROR] '.$e->getMessage()."\nMetadata: ".json_encode(['file' => $file->path, 'branch' => $branch->id]));
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
