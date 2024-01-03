<?php

namespace App\Actions\Platform\Projects;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProject
{
    use AsAction;

    public function handle(Team $team, string $name): Project
    {
        $project = $team->projects()->create([
            'name' => $name,
        ]);

        return $project;
    }

    public function asController(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Gate::authorize('create-project');

        $project = $this->handle($request->user()->currentTeam, $request->input('name'));

        return redirect()->route('projects.show', ['project' => $project]);
    }
}
