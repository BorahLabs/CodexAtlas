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
        $data = [
            'total' => 0,
            'processed' => 0,
            'finished' => false,
            'systemComponents' => [],
        ];
        if ($branch) {
            $data['total'] = $branch->systemComponents()->count();
            $data['processed'] = $branch->systemComponents()
                ->whereNotIn('status', [SystemComponentStatus::Pending, SystemComponentStatus::Generating])
                ->count();
            $data['systemComponents'] = $branch->systemComponents()->pluck('status', 'path');
        }

        $data['finished'] = $data['total'] > 0 && $data['processed'] === $data['total'];

        return view('autodoc.livewire.lead-status', $data);
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
