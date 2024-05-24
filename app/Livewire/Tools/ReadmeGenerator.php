<?php

namespace App\Livewire\Tools;

use App\Actions\Codex\Readme\GenerateOfflineReadme;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class ReadmeGenerator extends Component
{
    use WithFileUploads;

    public $zip = null;

    public ?string $readme = null;

    public function render()
    {
        return view('livewire.tools.readme-generator');
    }

    public function updatedZip()
    {
        $this->generate();
    }

    public function generate()
    {
        $this->resetErrorBag();
        $this->readme = null;
        $this->validate([
            'zip' => 'required|file|mimes:zip',
        ]);

        try {
            $readme = GenerateOfflineReadme::run($this->zip);
        } catch (\Exception $e) {
            $this->addError('zip', $e->getMessage());

            return;
        }

        $this->readme = $readme;
    }

    public function download()
    {
        return response()->streamDownload(function () {
            echo $this->readme;
        }, 'README.md');
    }
}
