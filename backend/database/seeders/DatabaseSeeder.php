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
        \App\Models\User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@codexatlas.app',
        ]);

        \App\Models\Team::create([
            'name' => 'Codex Atlas',
        ]);

        $this->call([
            RepositorySeeder::class,
        ]);
    }
}
