<?php

namespace Database\Seeders;

use App\Enums\SourceCodeProvider;
use App\Models\Project;
use App\Models\Repository;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RepositorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $team = Team::firstOrFail();
        $sourceCodeAccount = SourceCodeAccount::create([
            'team_id' => $team->id,
            'provider' => SourceCodeProvider::LocalFolder,
            'name' => config('codex.dev.local_folder'),
            'external_id' => config('codex.dev.local_folder'),
        ]);

        $projects = collect(config('codex.dev.projects'))
            ->values()
            ->unique()
            ->values()
            ->mapWithKeys(fn (string $name) => [$name => Project::create([
                'team_id' => $team->id,
                'name' => $name,
            ])])
            ->all();

        $provider = $sourceCodeAccount->getProvider();
        foreach ($provider->repositories() as $repositoryDto) {
            $repository = Repository::create([
                'source_code_account_id' => $sourceCodeAccount->id,
                'project_id' => $projects[config('codex.dev.projects')[$repositoryDto->name]]->id,
                'username' => dirname($repositoryDto->id),
                'name' => $repositoryDto->name,
            ]);

            $repository->branches()->create([
                'name' => 'main',
            ]);
        }
    }
}
