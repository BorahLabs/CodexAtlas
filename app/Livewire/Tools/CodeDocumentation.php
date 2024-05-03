<?php

namespace App\Livewire\Tools;

use App\Actions\Autodoc\ProcessAutodocSystemComponent;
use App\Actions\InternalNotifications\LogUserPerformedAction;
use App\Atlas\Guesser;
use App\Atlas\Languages\Contracts\Language;
use App\Enums\SystemComponentStatus;
use App\Models\SystemComponent;
use App\Models\Tool;
use App\SourceCode\DTO\File;
use Illuminate\Support\Facades\Cache;
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
    public string $ip;

    #[Locked]
    public ?string $systemComponentId = null;

    public ?string $filePath;

    public ?SystemComponent $systemComponent;

    public ?TemporaryUploadedFile $file = null;

    public function mount()
    {
        $this->ip = request()->ip();
    }

    public function updatedFile()
    {
        $this->resetErrorBag();
        if (is_null($this->file)) {
            return;
        }

        if ($this->userExceedsLimitsOfRequests()) {
            $this->addError('file', 'You have exceeded the limit of requests. Please, try again later or sign up.');

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

        Cache::increment('code-documentation:user-requests:'.$this->ip);
        ProcessAutodocSystemComponent::dispatch($systemComponent, model: 'gpt-3.5-turbo-1106');
        LogUserPerformedAction::dispatch(
            \App\Enums\Platform::Codex,
            \App\Enums\NotificationType::Success,
            'User used tool '.$tool->name,
            [
                'language' => $language->name(),
            ],
        );
        $this->systemComponent = $systemComponent;
        $this->filePath = $file->path;
    }

    public function userExceedsLimitsOfRequests(): bool
    {
        return Cache::get('code-documentation:user-requests:'.$this->ip, 0) >= 30;
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
