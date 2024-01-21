<?php

use App\Models\Project;
use App\Models\SourceCodeAccount;
use App\Models\Team;
use App\SourceCode\DTO\RepositoryName;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/*
|--------------------------------------------------------------------------
| Test Case
|--------------------------------------------------------------------------
|
| The closure you provide to your test functions is always bound to a specific PHPUnit test
| case class. By default, that class is "PHPUnit\Framework\TestCase". Of course, you may
| need to change it using the "uses()" function to bind a different classes or traits.
|
*/

uses(TestCase::class, RefreshDatabase::class)->in('Feature');

/*
|--------------------------------------------------------------------------
| Expectations
|--------------------------------------------------------------------------
|
| When you're writing tests, you often need to check that values meet certain conditions. The
| "expect()" function gives you access to a set of "expectations" methods that you can use
| to assert different things. Of course, you may extend the Expectation API at any time.
|
*/

expect()->extend('toBeOne', function () {
    return $this->toBe(1);
});

/*
|--------------------------------------------------------------------------
| Functions
|--------------------------------------------------------------------------
|
| While Pest is very powerful out-of-the-box, you may have some testing code specific to your
| project that you don't want to repeat in every file. Here you can also expose helpers as
| global functions to help you to reduce the number of lines of code in your test files.
|
*/

function createLaravelProject(Team $team) {
    $project = Project::factory()->create([
        'team_id' => $team->id,
    ]);
    $sourceCodeAccount = SourceCodeAccount::factory()->github()->create([
        'team_id' => $team->id,
    ]);
    $repo = new RepositoryName(username: 'laravel', name: 'laravel');
    $repository = $project->repositories()->create([
        'source_code_account_id' => $sourceCodeAccount->id,
        'project_id' => $project->id,
        'username' => $repo->username,
        'name' => $repo->name,
        'workspace' => $repo->workspace ?? null,
    ]);

    $branch = $repository->branches()->createQuietly(['name' => 'master']);

    return [$project, $sourceCodeAccount, $repository, $branch];
}
