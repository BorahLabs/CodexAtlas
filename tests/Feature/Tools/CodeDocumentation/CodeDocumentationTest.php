<?php

use App\Actions\Autodoc\ProcessAutodocSystemComponent;
use App\Atlas\Guesser;
use App\Atlas\Languages\Python;
use App\Enums\SystemComponentStatus;
use App\Livewire\Tools\CodeDocumentation;
use App\Models\SystemComponent;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Queue;
use Livewire\Livewire;

test('homepage has all links', function () {
    $languages = Guesser::supportedLanguages();
    $response = $this->get(route('homepage'));

    foreach ($languages as $language) {
        $response->assertSee($language->name().' Code Documentation');
    }
});

test('can access all links', function () {
    $languages = Guesser::supportedLanguages();
    foreach ($languages as $language) {
        $this
            ->get(route('tools.code-documentation', ['language' => str($language->name())->slug()]))
            ->assertStatus(200)
            ->assertSee('Free '.$language->name().' Code Documentation')
            ->assertSeeLivewire(CodeDocumentation::class);
    }
});

test('cannot access non-existent languages', function () {
    $this
        ->get(route('tools.code-documentation', ['language' => 'klingon']))
        ->assertStatus(404);
});

test('can upload a file and gets documented', function () {
    Queue::fake();

    expect(SystemComponent::count())->toBe(0);
    $contents = 'print("Hello World")';
    Livewire::test(CodeDocumentation::class, [
        'language' => (new Python())->name(),
    ])
        ->set('file', UploadedFile::fake()->createWithContent('code.py', $contents));

    $systemComponent = SystemComponent::first();
    expect($systemComponent->status)->toBe(SystemComponentStatus::Pending);
    expect($systemComponent->file_contents)->toBe($contents);
    ProcessAutodocSystemComponent::assertPushed(1);
});

test('cannot upload a file from another language', function () {
    Queue::fake();

    expect(SystemComponent::count())->toBe(0);
    $contents = 'console.log("Hello World")';
    Livewire::test(CodeDocumentation::class, [
        'language' => (new Python())->name(),
    ])
        ->set('file', UploadedFile::fake()->createWithContent('code.js', $contents))
        ->assertHasErrors([
            'file' => 'The file is not a Python file.',
        ]);

    expect(SystemComponent::count())->toBe(0);
    ProcessAutodocSystemComponent::assertNotPushed();
});

test('cannot exceed limit of requests', function () {
    Queue::fake();

    expect(SystemComponent::count())->toBe(0);
    $contents = 'print("Hello World")';
    for ($i = 0; $i < 30; $i++) {
        Livewire::test(CodeDocumentation::class, [
            'language' => (new Python())->name(),
        ])
            ->set('file', UploadedFile::fake()->createWithContent('code.py', $contents))
            ->assertHasNoErrors();
    }

    Livewire::test(CodeDocumentation::class, [
        'language' => (new Python())->name(),
    ])
        ->set('file', UploadedFile::fake()->createWithContent('code.py', $contents))
        ->assertHasErrors([
            'file' => 'You have exceeded the limit of requests. Please, try again later or sign up.',
        ]);
    ProcessAutodocSystemComponent::assertPushed(30);
});
