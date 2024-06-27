<?php

namespace App\Livewire\Autodoc;

use App\Actions\Codex\Architecture\SystemComponents\ConvertSystemComponentMarkdown;
use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
use App\LLM\PromptRequests\PromptRequestType;
use App\Models\AutodocLead;
use App\Models\Project;
use App\SourceCode\DTO\File;
use Illuminate\Contracts\Filesystem\Filesystem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Laravel\Cashier\Cashier;
use Livewire\Attributes\Computed;
use Livewire\Component;

class Autodoc extends Component
{
    protected $listeners = [
        'autodoc:lead-registered' => 'leadRegistered',
        'autodoc:file-uploaded' => 'fileUploaded',
    ];

    public ?array $data = [];

    public ?AutodocLead $lead = null;

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('autodoc.livewire.autodoc');
    }

    public function leadRegistered(string $leadId): void
    {
        $this->lead = AutodocLead::findOrFail($leadId);
    }

    public function fileUploaded(): void
    {
        $this->lead->refresh();
    }

    #[Computed]
    public function priceInCents(): int
    {
        return max(1000, $this->lead->number_of_files * 20);
    }

    #[Computed]
    public function formattedPrice(): string
    {
        return '$'.number_format($this->priceInCents / 100, 2);
    }

    public function processFirstFile(): void
    {
        abort_if(is_null($this->lead->first_file), 500, 'Could not find code.');

        if ($this->lead->first_file_completion) {
            return;
        }

        /**
         * @var Llm
         */
        $llm = app(Llm::class);
        if ($llm instanceof OpenAI) {
            $llm->withModel('gpt-4o');
        }

        $file = File::from(json_decode($this->lead->first_file, true));
        $completion = $llm->describeFile(new Project(['name' => '']), $file, PromptRequestType::DOCUMENT_FILE);
        $completion = ConvertSystemComponentMarkdown::make()->handle(json_decode($completion->completion, true), $file->path);
        $this->lead->update([
            'first_file_completion' => $completion,
        ]);
    }

    public function pay(): RedirectResponse|\Livewire\Features\SupportRedirects\Redirector
    {
        $stripe = Cashier::stripe();
        $session = $stripe->checkout->sessions->create([
            'success_url' => URL::signedRoute('autodoc.success', ['autodocLead' => $this->lead]),
            'allow_promotion_codes' => true,
            'line_items' => [
                [
                    'quantity' => 1,
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => 'Code documentation',
                            'description' => 'Documentation for '.$this->lead->number_of_files.' files',
                        ],
                        'unit_amount' => $this->priceInCents,
                    ],
                ],
            ],
            'metadata' => [
                'autodoc_lead_id' => $this->lead->id,
            ],
            'mode' => 'payment',
        ]);

        $this->lead->update([
            'stripe_session_id' => $session->id,
            'status' => 'paying',
        ]);

        return redirect($session->url);
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
