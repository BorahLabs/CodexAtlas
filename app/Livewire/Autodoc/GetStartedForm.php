<?php

namespace App\Livewire\Autodoc;

use App\Forms\Components\Turnstile;
use App\Models\AutodocLead;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class GetStartedForm extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public bool $captchaError = false;

    public function mount()
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->rules('email:rfc,dns')
                    ->label('Type your email')
                    ->placeholder('john.doe@email.com')
                    ->autofocus()
                    ->validationAttribute('email')
                    ->required()
                    ->helperText('We will use it to send you the documentation. No spam.'),
                // Turnstile::make('turnstile'),
            ])
            ->statePath('data');
    }

    public function submitEmail(): void
    {
        $this->captchaError = false;
        $data = $this->form->getState();

        // if (! Turnstile::verify($data['turnstile'] ?? '')) {
        //     $this->captchaError = true;
        //     return;
        // }

        $lead = AutodocLead::create([
            'email' => $data['email'],
            'ip_address' => request()->ip(),
        ]);

        $this->dispatch('autodoc:lead-registered', $lead->id);
    }

    public function render()
    {
        return view('autodoc.livewire.get-started-form');
    }
}
