<?php

namespace App\Livewire\Autodoc;

use App\Actions\Autodoc\ExtractZip;
use App\Actions\Autodoc\GetFiles;
use App\Actions\Codex\Architecture\FilterFilesByFramework;
use App\Models\AutodocLead;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class UploadFile extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public AutodocLead $lead;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('file')
                    ->label('Your code')
                    ->required()
                    ->acceptedFileTypes(['application/zip'])
                    ->storeFileNamesIn('originalFileName')
                    ->disk('tmp')
                    ->helperText('Your code will be deleted from our servers right after it\'s documented.'),
            ])
            ->statePath('data');
    }

    public function render()
    {
        return view('autodoc.livewire.upload-file');
    }

    public function uploadFile(): void
    {
        $data = $this->form->getState();
        $baseName = str(basename($data['file']))->beforeLast('.zip')->toString();

        $folderPath = ExtractZip::make()->handle($data['file'], $baseName);
        [$repoName, $filesAndFolders] = GetFiles::make()->handle($baseName);
        [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);

        if (count($files) === 0) {
            return;
        }

        $contents = $files[0]->contents();
        $firstFile = [
            'name' => $files[0]->name,
            'path' => $files[0]->path,
            'sha' => $files[0]->sha,
            'download_url' => $files[0]->downloadUrl,
            'content' => base64_encode($contents),
        ];

        Storage::disk('tmp')->deleteDirectory($folderPath);

        $this->lead->update([
            'zip_path' => $data['file'],
            'number_of_files' => count($files),
            'first_file' => json_encode($firstFile),
            'framework' => $framework->name(),
        ]);

        $this->dispatch('autodoc:file-uploaded');
    }
}
