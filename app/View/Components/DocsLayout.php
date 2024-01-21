<?php

namespace App\View\Components;

use App\Models\Branch;
use App\Models\Project;
use App\Models\Repository;
use Carbon\Carbon;
use Illuminate\View\Component;
use Illuminate\View\View;

class DocsLayout extends Component
{
    public function __construct(
        public readonly Project $project,
        public readonly Repository $repository,
        public readonly Branch $branch,
        public readonly ?Carbon $lastModifiedAt = null,
    ) {
        //
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.docs');
    }
}
