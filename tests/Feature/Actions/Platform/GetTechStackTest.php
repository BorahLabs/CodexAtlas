<?php

use App\Actions\Platform\GetTechStack;
use App\Models\User;
use App\SourceCode\DTO\File;
use Illuminate\Support\Facades\Cache;

it('gets the techStack of a project', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $techStack = GetTechStack::make()->handle($repository, $branch);
    expect($techStack->contents())
        ->toBeString()
        ->toContain('worked');
});

it('gets the techStack of a project from cache', function () {
    $user = User::factory()->inFreeTrialMode()->create();
    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);
    $cachedTechStack = $branch->branchDocuments()->updateOrCreate(
        ['path' => 'TechStackFile'],
        ['name' => 'TechStackFile', 'content' => 'test TechStackFile']
    );
    $file = new File($cachedTechStack->name, $cachedTechStack->path, '', '', $cachedTechStack->content);
    Cache::put(sha1($cachedTechStack->content), $file, now()->addMinute(1));
    $cachedTechStack = GetTechStack::make()->handle($repository, $branch);
    expect($cachedTechStack->contents())
        ->toBeString()
        ->toContain('test TechStackFile');
});

