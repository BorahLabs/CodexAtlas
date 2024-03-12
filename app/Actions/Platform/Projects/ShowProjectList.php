<?php

namespace App\Actions\Platform\Projects;

use Lorisleiva\Actions\Concerns\AsAction;

class ShowProjectList
{
    use AsAction;

    public function handle(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('dashboard', [
            'projects' => auth()->user()->currentTeam->projects,
        ]);
    }
}
