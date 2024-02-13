<?php

namespace App\Livewire\Autodoc;

use App\Actions\Platform\DownloadDocsAsMarkdown;
use App\Enums\SystemComponentStatus;
use App\Models\AutodocLead;
use Livewire\Component;

class LeadStatus extends Component
{
    public AutodocLead $autodocLead;

    public function render()
    {
        $branch = $this->autodocLead->branch;
        $total = $branch->systemComponents()->count();
        $processed = $branch->systemComponents()
            ->whereNotIn('status', [SystemComponentStatus::Pending, SystemComponentStatus::Generating])
            ->count();
        $systemComponents = $branch->systemComponents()->pluck('status', 'path');

        return view('autodoc.livewire.lead-status', [
            'processed' => $processed,
            'total' => $total,
            'finished' => $processed === $total,
            'systemComponents' => $systemComponents,
        ]);
    }

    public function downloadDocs()
    {
        $branch = $this->autodocLead->branch;
        $repository = $branch->repository;
        $project = $repository->project;
        $path = DownloadDocsAsMarkdown::make()->handle($project, $repository, $branch, withReadme: false);
        return response()->download($path, 'documentation.zip')->deleteFileAfterSend();
    }
}
