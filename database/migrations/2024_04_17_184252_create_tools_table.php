<?php

use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use App\Models\Tool;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('data')->nullable();
            $table->timestamps();
        });

        $codeDocumentationTool = Tool::create([
            'name' => 'code-documentation',
        ]);

        $user = User::create([
            'name' => 'Code Documentation',
            'email' => 'codedocumentation@codexatlas.app',
            'password' => bcrypt(Str::random(16)),
            'email_verified_at' => now(),
        ]);

        $team = Team::create([
            'name' => 'Code Documentation',
            'personal_team' => 1,
            'user_id' => $user->id,
        ]);

        $account = SourceCodeAccount::createQuietly([
            'team_id' => $team->id,
            'provider' => 'local',
            'name' => 'Code Documentation',
            'external_id' => 'code-documentation',
        ]);

        $project = Project::createQuietly([
            'team_id' => $team->id,
            'name' => 'Code Documentation',
        ]);

        $repository = $project->repositories()->createQuietly([
            'source_code_account_id' => $account->id,
            'username' => 'code-documentation',
            'name' => 'Code Documentation',
        ]);

        $branch = $repository->branches()->createQuietly([
            'name' => 'tool',
        ]);

        $codeDocumentationTool->update([
            'data' => [
                'branch_id' => $branch->id,
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
