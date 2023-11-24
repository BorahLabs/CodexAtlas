<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@codexatlas.app',
        ]);

        \App\Models\Team::create([
            'name' => 'Codex Atlas',
            'user_id' => $user->id,
            'personal_team' => true,
        ]);

        $this->call([
            RepositorySeeder::class,
        ]);
    }
}
