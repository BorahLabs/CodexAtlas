<?php

namespace App\Livewire\Teams;

use App\LLM\OpenAI;
use Livewire\Component;

class OpenaiManager extends Component
{
    public string $key = '';

    public bool $isEditing = false;

    public function mount(): void
    {
        $this->isEditing = is_null(auth()->user()->currentTeam->openai_key);
    }

    public function saveKey(): void
    {
        if (! $this->isEditing) {
            return;
        }

        $this->resetErrorBag('key');

        $client = new OpenAI();
        if (! $client->checkApiKey($this->key)) {
            $this->addError('key', 'The provided API key is not valid. Please, try again.');

            return;
        }

        auth()->user()->currentTeam->update([
            'openai_key' => $this->key,
        ]);
        $this->isEditing = false;
        $this->dispatch('saved');
    }

    public function render(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory
    {
        return view('teams.openai-manager');
    }
}
