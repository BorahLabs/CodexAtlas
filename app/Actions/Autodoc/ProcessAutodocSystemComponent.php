<?php

namespace App\Actions\Autodoc;

use App\Actions\Codex\Architecture\SystemComponents\ConvertSystemComponentMarkdown;
use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\AutodocLead;
use App\Models\ProcessingLogEntry;
use App\Models\Project;
use App\Models\SystemComponent;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class ProcessAutodocSystemComponent
{
    use AsAction;

    public function handle(SystemComponent $systemComponent, ?AutodocLead $lead = null, string $model = 'gpt-4-turbo')
    {
        if (empty(trim($systemComponent->file_contents))) {
            $systemComponent->updateQuietly([
                'status' => SystemComponentStatus::Error,
            ]);
            if ($lead) {
                $this->checkIfShouldFinish($lead);
            }

            abort(422, 'File contents are empty');
        }

        $lead?->update([
            'status' => SystemComponentStatus::Generating->value,
        ]);
        $systemComponent->updateQuietly([
            'status' => SystemComponentStatus::Generating,
        ]);

        try {
            /**
             * @var Llm
             */
            $llm = app(Llm::class);
            if ($llm instanceof OpenAI) {
                $llm->withModel($model);
            }

            $file = File::from([
                'name' => $systemComponent->name,
                'path' => $systemComponent->path,
                'sha' => $systemComponent->sha,
                'download_url' => '',
                'content' => base64_encode($systemComponent->file_contents),
            ]);
            $completion = retry(3, fn () => $llm->describeFile(new Project(['name' => '']), $file, PromptRequestType::DOCUMENT_FILE), 5000);
            $systemComponent->updateQuietly([
                'markdown_docs' => ConvertSystemComponentMarkdown::make()->handle(json_decode($completion->completion, true), $file->path),
                'file_contents' => null,
                'json_docs' => json_decode($completion->completion, true),
                'status' => SystemComponentStatus::Generated,
            ]);
            ProcessingLogEntry::write($systemComponent->branch, $file->path, class_basename($llm), $llm->modelName(), $completion);
        } catch (\Exception $e) {
            $systemComponent->updateQuietly([
                'file_contents' => null,
                'status' => SystemComponentStatus::Error,
            ]);
        }

        if ($lead) {
            $this->checkIfShouldFinish($lead);
        }
    }

    protected function checkIfShouldFinish(AutodocLead $lead)
    {
        $total = $lead->branch->systemComponents()->count();
        $processed = $lead->branch->systemComponents()
            ->whereNotIn('status', [SystemComponentStatus::Pending, SystemComponentStatus::Generating])
            ->count();
        $finished = $total > 0 && $processed === $total;
        if ($finished) {
            FinishLeadProcessing::run($lead);
        }
    }
}
