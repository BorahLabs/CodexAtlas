<?php

namespace App\Actions\Autodoc;

use App\Enums\SystemComponentStatus;
use App\Models\AutodocLead;
use App\Models\SystemComponent;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsController;

class ShowStatus
{
    use AsController;

    public function asController(AutodocLead $autodocLead, Request $request)
    {
        $branch = $autodocLead->branch;
        $total = $branch->systemComponents()->count();
        $processed = $branch->systemComponents()
            ->whereNotIn('status', [SystemComponentStatus::Pending, SystemComponentStatus::Generating])
            ->count();
        $systemComponents = $branch->systemComponents()->pluck('status', 'path');

        return view('autodoc.status', [
            'autodocLead' => $autodocLead,
            'processed' => $processed,
            'total' => $total,
            'finished' => $processed === $total,
            'systemComponents' => $systemComponents,
        ]);
    }
}
