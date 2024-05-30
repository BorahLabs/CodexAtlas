<?php

namespace App\Livewire\PlatformTools;

use App\Atlas\Guesser;
use Livewire\Attributes\Computed;
use Livewire\Component;

class CodeDocumentation extends Component
{
    public ?string $language = null;

    public function render()
    {
        return view('livewire.platform-tools.code-documentation');
    }

    #[Computed]
    public function languages()
    {
        return Guesser::supportedLanguages();
    }
}
