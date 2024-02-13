<?php

namespace App\Livewire\Autodoc;

use App\Actions\Codex\Architecture\FilterFilesByFramework;
use App\Actions\LocalFolder\GetAllFiles;
use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
use App\Models\Project;
use App\SourceCode\DTO\Branch;
use App\SourceCode\DTO\RepositoryName;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Forms;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use ZipArchive;

class Autodoc extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public ?string $email = null;
    public ?string $zipPath = null;
    public ?string $completion = null;
    public ?int $numberOfFiles = null;

    public function mount()
    {
        $this->form->fill();
    }

    public function render()
    {
        return view('autodoc.livewire.autodoc');
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
                    ->disk('tmp'),
            ])
            ->statePath('data');
    }

    #[Computed]
    public function priceInCents(): int
    {
        return match(true) {
            $this->numberOfFiles <= 100 => 1000,
            $this->numberOfFiles <= 500 => 4000,
            $this->numberOfFiles <= 1000 => 7000,
            default => 0,
        };
    }

    #[Computed]
    public function formattedPrice(): string
    {
        return number_format($this->priceInCents / 100, 2) . '€';
    }

    public function uploadFile(): void
    {
        $data = $this->form->getState();
        $filePath = $this->disk()->path($data['file']);
        $baseName = $this->getBaseName();
        $absolutePath = $this->extractZip($filePath, $baseName);
        [$repoName, $filesAndFolders] = $this->getFiles($baseName, $absolutePath);
        [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);

        $this->zipPath = $absolutePath;
        $this->numberOfFiles = count($files);
    }

    public function processFirstFile(): void
    {
        abort_if($this->zipPath === null, 500, 'No zip file has been loaded yet.');

        $data = $this->form->getState();
        $baseName = $this->getBaseName();
        [$repoName, $filesAndFolders] = $this->getFiles($baseName, $this->zipPath);
        [$framework, $files] = FilterFilesByFramework::make()->handle($filesAndFolders, $repoName);

        $fileName = str(basename($data['originalFileName']))->before('.zip')->toString();
        /**
         * @var Llm
         */
        $llm = app(Llm::class);
        if ($llm instanceof OpenAI) {
            $llm->withModel('gpt-4-turbo-preview');
        }

        $completion = $llm->describeFile(new Project(['name' => $fileName]), $files[0]);
        $this->completion = $completion->completion;
    }

    protected function extractZip(string $filePath, string $baseName): string
    {
        $zip = new ZipArchive();
        $res = $zip->open($filePath);
        if ($res !== true) {
            throw new \Exception('Could not open zip file');
        }

        if ($this->disk()->exists($baseName)) {
            $this->disk()->deleteDirectory($baseName);
        }

        $absolutePath = $this->disk()->path($baseName);
        $zip->extractTo($absolutePath);
        $zip->close();
        unlink($filePath);

        return $absolutePath;
    }

    protected function getFiles(string $baseName, string $absolutePath): array
    {
        $repoName = '';
        do {
            $directories = $this->disk()->directories($baseName.DIRECTORY_SEPARATOR.$repoName);
            if (count($directories) !== 1) {
                break;
            }

            $repoName = $directories[0];
        } while (count($directories) === 1);

        $repoName = str($repoName)->after($baseName.DIRECTORY_SEPARATOR)->toString();
        $repository = new RepositoryName(
            username: $absolutePath,
            name: $repoName,
        );
        $files = GetAllFiles::make()->handle(
            repository: $repository,
            branch: new Branch(name: 'main'),
        );

       return [$repository, $files];
    }

    protected function getBaseName(): string
    {
        $data = $this->form->getState();
        $filePath = $this->disk()->path($data['file']);
        $baseName = str(basename($filePath))->beforeLast('.zip')->toString();

        return $baseName;
    }

    protected function disk(): Filesystem
    {
        return Storage::disk('tmp');
    }
}
