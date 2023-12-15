<?php

use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $user = \App\Models\User::create([
            'name' => 'Admin',
            'email' => 'admin@codexatlas.app',
            'email_verified_at' => now(),
            'password' => bcrypt('password'),
        ]);

        \App\Models\Team::create([
            'name' => 'Codex Atlas',
            'user_id' => $user->id,
            'personal_team' => true,
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
