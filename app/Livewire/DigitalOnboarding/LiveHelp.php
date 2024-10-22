<?php

namespace App\Livewire\DigitalOnboarding;

use App\Enums\SoRequirementType;
use App\LLM\Contracts\Llm;
use App\LLM\OpenAI;
use App\Models\Project;
use Illuminate\Support\Str;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms;
use Filament\Forms\Form;
use Livewire\Attributes\Url;
use Livewire\Component;

class LiveHelp extends Component implements HasForms
{
    use InteractsWithForms;

    public Project $project;

    #[Url(keep: true)]
    public string $email;

    public array $data = [];

    public array $messages = [];

    public string $newMessageUser = '';
    public string $newMessageAssistant = '';

    public function mount()
    {
        $this->messages = session()->get('live-chat-'.$this->email, []);
    }

    public function resetMessages()
    {
        $this->messages = [];
        session()->put('live-chat-'.$this->email, []);
    }

    public function render()
    {
        return view('livewire.digital-onboarding.live-help');
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Textarea::make('message')
                    ->label('What do you need help with?')
                    ->required()
                    ->grow(),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();
        if (empty($this->messages)) {
            $this->messages = [
                [
                    'role' => 'system',
                    'content' => $this->systemPrompt()
                ]
            ];
        }

        $this->messages[] = [
            'role' => 'user',
            'content' => $data['message']
        ];

        $this->stream(
            to: 'newMessageUser',
            content: $data['message'],
            replace: true,
        );

        $openai = new OpenAI();
        $response = $openai->chat($this->messages, function ($content) {
            $this->stream(
                to: 'newMessageAssistant',
                content: Str::markdown($content),
                replace: true,
            );
        });

        $this->messages[] = [
            'role' => 'assistant',
            'content' => $response->completion,
        ];

        session()->put('live-chat-'.$this->email, $this->messages);

        $this->newMessageUser = '';
        $this->newMessageAssistant = '';

        $this->form->fill();
    }

    private function systemPrompt(): string
    {
        $prompt = 'You are a helpful assistant expert in software development. You are helping a colleague with their project setup. You are given a message from the user and you need to respond with a helpful answer.';
        $prompt .= "\n\nHere you have some additional information about the project and what your colleague is trying to set up:\n\n";

        $prompt .= "- Project name: {$this->project->name}\n";
        $prompt .= "{$this->project->context}\n\n";

        $os = session()->get('onboarding_system_'.$this->email);
        $os = $os ? SoRequirementType::from($os) : SoRequirementType::fromUserAgent(request()->userAgent());

        $prompt .= "- Operating System: {$os->getLabel()}\n\n";
        $prompt .= "- System requirements:\n";
        foreach ($this->project->requirementsFor($os) as $i => $requirement) {
            $prompt .= ($i + 1).". {$requirement['title']}\n";
            $prompt .= "{$requirement['description']}\n\n";
        }

        $prompt .= "- Project repositories: " . $this->project->repositories->pluck('full_name')->implode(', ') . "\n";
        $prompt .= "These are the instructions to run each repository:\n\n";

        foreach ($this->project->repositories as $repository) {
            $prompt .= "- {$repository->full_name}\n";
            foreach ($repository->repositoryInstructions as $i => $instruction) {
                $prompt .= ($i + 1).". {$instruction->title}\n";
                $prompt .= "{$instruction->description}\n\n";
            }
        }

        return $prompt;
    }
}
