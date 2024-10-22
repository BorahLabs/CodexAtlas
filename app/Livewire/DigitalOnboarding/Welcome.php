<?php

namespace App\Livewire\DigitalOnboarding;

use App\Livewire\DigitalOnboarding\Traits\HasNavigation;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;

class Welcome extends Component implements HasForms
{
    use InteractsWithForms;
    use HasNavigation;

    public array $data = [];

    public function render()
    {
        return view('livewire.digital-onboarding.welcome');
    }

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
                    ->required(),
            ])
            ->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState();
        $this->dispatch('set-email', $data['email']);
    }
}
