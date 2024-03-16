<?php

namespace App\View\Components;

use App\Models\Project;
use Illuminate\View\Component;
use Illuminate\View\View;

class ProjectLayout extends Component
{
    public function __construct(
        public Project $project,
    ) {
        //
    }

    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        return view('layouts.project');
    }
}
