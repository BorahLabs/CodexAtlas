<?php

use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = User::create([
            'name' => 'Autodoc',
            'email' => 'autodoc@codexatlas.app',
            'password' => bcrypt(Str::random(16)),
            'email_verified_at' => now(),
        ]);

        $team = Team::create([
            'name' => 'Autodoc',
            'personal_team' => 1,
            'user_id' => $user->id,
        ]);

        $account = SourceCodeAccount::create([
            'team_id' => $team->id,
            'provider' => 'local',
            'name' => 'Autodoc',
            'external_id' => 'autodoc',
        ]);

        $project = Project::create([
            'team_id' => $team->id,
            'name' => 'Autodoc',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
