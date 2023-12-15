<?php

namespace App\Actions\Platform\Projects;

use App\Models\Project;
use App\Models\Team;
use Illuminate\Http\Request;
use Lorisleiva\Actions\Concerns\AsAction;

class StoreProject
{
    use AsAction;

    public function handle(Team $team, string $name): Project
    {
        return $team->projects()->create([
            'name' => $name,
        ]);
    }

    public function asController(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $project = $this->handle($request->user()->currentTeam, $request->input('name'));

        return redirect()->route('projects.show', ['project' => $project]);
    }
}
