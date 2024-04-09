<?php

use App\Actions\Codex\Architecture\SystemComponents\ProcessSystemComponent;
use App\Actions\Codex\GenerateTechStackDocumentation;
use App\Actions\Codex\UpdateDocumentationFromDiff;
use App\Enums\FileChange;
use App\Models\SystemComponent;
use App\Models\User;
use App\SourceCode\DTO\Diff;
use App\SourceCode\DTO\DiffItem;
use Illuminate\Support\Facades\Queue;

it('Delete system component when removed from source code provider', function () {
    $user = User::factory()->inFreeTrialMode()->create();

    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    $systemComponent = $branch->systemComponents()->create([
        'order' => 1,
        'path' => 'app/Clients/TestClient.php',
        'sha' => sha1('test'),
        'markdown_docs' => '## Test Client',
        'status' => 'generated',
    ]);

    expect($branch->systemComponents()->find($systemComponent->id))->not->toBe(null);

    UpdateDocumentationFromDiff::run($branch, generateRemovedFileDiff($systemComponent));

    expect($branch->systemComponents()->find($systemComponent->id))->toBe(null);
});

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

it('dont create system component when there is push and file is ignorable', function () {

    Queue::fake();

    $user = User::factory()->inFreeTrialMode()->create();

    [$project, $sourceCodeAccount, $repository, $branch] = createLaravelProject($user->currentTeam);

    ProcessSystemComponent::assertPushed(0);

    UpdateDocumentationFromDiff::run($branch, generateIgnorableDiff());

    ProcessSystemComponent::assertPushed(0);
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

function generateIgnorableDiff(): Diff
{
    $diff = new Diff();
    $diffItem = new DiffItem('app/Providers/AppServiceProvider.php', FileChange::Modified);
    $diff->add($diffItem);

    return $diff;
}

function generateRemovedFileDiff(SystemComponent $systemComponent): Diff
{
    $diff = new Diff();
    $diffItem = new DiffItem($systemComponent->path, FileChange::Removed);
    $diff->add($diffItem);

    return $diff;
}
