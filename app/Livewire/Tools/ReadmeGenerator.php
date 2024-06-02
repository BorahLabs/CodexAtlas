<?php

namespace App\Livewire\Tools;

use App\Actions\Codex\Readme\GenerateOfflineReadme;
use App\Actions\InternalNotifications\LogUserPerformedAction;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ReadmeGenerator extends Component
{
    use WithFileUploads;

    #[Locked]
    public bool $isFromPlatform = false;

    public mixed $zip = null;

    public ?string $readme = null;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('livewire.tools.readme-generator');
    }

    public function updatedZip(): void
    {
        $this->generate();
    }

    public function generate(): void
    {
        $this->resetErrorBag();
        $this->readme = null;
        $this->validate([
            'zip' => 'required|file|mimes:zip',
        ]);

        try {
            // TODO: Online readme if it's from platform
            $readme = GenerateOfflineReadme::run($this->zip);
        } catch (\Exception $e) {
            $this->addError('zip', $e->getMessage());

            return;
        }

        $this->readme = $readme;

        LogUserPerformedAction::dispatch(
            \App\Enums\Platform::Codex,
            \App\Enums\NotificationType::Success,
            'User used README Generator',
        );
    }

    public function download(): StreamedResponse
    {
        return response()->streamDownload(function () {
            echo $this->readme;
        }, 'README.md');
    }
}
