<?php

namespace App\Actions\Platform\Glossary;

use App\Models\Project;
use Lorisleiva\Actions\Concerns\AsAction;

class ShowGlossary
{
    use AsAction;

    public function handle(Project $project): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('glossary-list', [
            'project' => $project,
        ]);
    }
}
