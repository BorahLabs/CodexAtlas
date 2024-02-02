<?php

use App\Actions\Codex\GenerateTechStackDocumentation;
use App\Actions\Codex\UpdateDocumentationFromDiff;
use App\Enums\FileChange;
use App\SourceCode\DTO\Diff;
use App\SourceCode\DTO\DiffItem;
use App\Models\User;
use Illuminate\Support\Facades\Queue;


it('update tech stack from difference recieved in webhook when changes in dependency file', function () {

    Queue::fake();

    $user = User::factory()->inFreeTrialMode()->create();

    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    GenerateTechStackDocumentation::assertPushed(0);

    UpdateDocumentationFromDiff::run($branch, generateFakeDependenciesModifiedDiff());

    GenerateTechStackDocumentation::assertPushed(1);
});

it('dont update tech stack from difference recieved in webhook when no changes in dependency file', function () {

    Queue::fake();

    $user = User::factory()->inFreeTrialMode()->create();

    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    GenerateTechStackDocumentation::assertPushed(0);

    UpdateDocumentationFromDiff::run($branch, generateFakeDiff());

    GenerateTechStackDocumentation::assertPushed(0);
});

function generateFakeDependenciesModifiedDiff(): Diff
{
    $diff = new Diff();
    $diffItem = new DiffItem('composer.json', FileChange::Modified);
    $diff->add($diffItem);
    return $diff;
}

function generateFakeDiff(): Diff
{
    $diff = new Diff();
    $diffItem = new DiffItem('test.php', FileChange::Modified);
    $diff->add($diffItem);
    return $diff;
}
