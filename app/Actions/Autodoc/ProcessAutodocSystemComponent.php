<?php

namespace App\Actions\Autodoc;

use App\Enums\SystemComponentStatus;
use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\AutodocLead;
use App\Models\Project;
use App\Models\SystemComponent;
use App\SourceCode\DTO\File;
use Lorisleiva\Actions\Concerns\AsAction;

class ProcessAutodocSystemComponent
{
    use AsAction;

    public function handle(SystemComponent $systemComponent, AutodocLead $lead)
    {
        abort_if(empty(trim($systemComponent->file_contents)), 422, 'File contents are empty');

        $lead->update([
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
                $llm->withModel('gpt-4-turbo-preview');
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
                'markdown_docs' => $completion->completion,
                'file_contents' => null,
                'status' => SystemComponentStatus::Generated,
            ]);
        } catch (\Exception $e) {
            $systemComponent->updateQuietly([
                'file_contents' => null,
                'status' => SystemComponentStatus::Error,
            ]);
        }

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
