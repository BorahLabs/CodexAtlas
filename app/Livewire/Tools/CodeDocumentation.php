<?php

namespace App\Livewire\Tools;

use App\Actions\Autodoc\ProcessAutodocSystemComponent;
use App\Atlas\Guesser;
use App\Atlas\Languages\Contracts\Language;
use App\Enums\SystemComponentStatus;
use App\Models\SystemComponent;
use App\Models\Tool;
use App\SourceCode\DTO\File;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CodeDocumentation extends Component
{
    use WithFileUploads;

    #[Locked]
    public string $language;

    #[Locked]
    public ?string $systemComponentId = null;

    public ?string $filePath;

    public ?SystemComponent $systemComponent;

    public ?TemporaryUploadedFile $file = null;

    public function updatedFile()
    {
        $this->resetErrorBag();
        if (is_null($this->file)) {
            return;
        }

        $prefix = Str::uuid();
        $contents = $this->file->getContent();
        $name = $this->file->getClientOriginalName();
        $file = new File(
            name: $name,
            path: $prefix.'/'.$name,
            sha: sha1($prefix.$contents),
            downloadUrl: '',
            contents: $contents,
        );
        $language = $this->language();
        if (! $language->isOwnFile($file)) {
            $this->addError('file', 'The file is not a '.$language->name().' file.');
            return;
        }

        $tool = Tool::codeDocumentation();
        $systemComponent = SystemComponent::create([
            'branch_id' => $tool->key('branch_id'),
            'order' => 0,
            'path' => $file->path,
            'sha' => $file->sha,
            'file_contents' => $contents,
            'markdown_docs' => null,
            'status' => SystemComponentStatus::Pending->value,
        ]);
        ProcessAutodocSystemComponent::dispatch($systemComponent);
        $this->systemComponent = $systemComponent;
        $this->filePath = $file->path;
    }

    public function render()
    {
        return view('livewire.tools.code-documentation', [
            'lang' => $this->language(),
        ]);
    }

    private function language(): Language
    {
        return collect(Guesser::supportedLanguages())->first(fn (Language $lang) => str($lang->name())->is($this->language));
    }
}
