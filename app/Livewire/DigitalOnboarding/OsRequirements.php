<?php

namespace App\Livewire\DigitalOnboarding;

use App\Enums\SoRequirementType;
use App\Livewire\DigitalOnboarding\Traits\HasNavigation;
use App\Models\Project;
use Livewire\Attributes\Url;
use Livewire\Component;

class OsRequirements extends Component
{
    use HasNavigation;

    public Project $project;

    #[Url(keep: true)]
    public string $email;

    public string $system = '';

    public function mount()
    {
        if ($ua = request()->userAgent()) {
            $this->system = SoRequirementType::fromUserAgent($ua)->value;
        } else {
            $this->system = SoRequirementType::MAC->value;
        }

        session()->put('onboarding_system_'.$this->email, $this->system);
    }

    public function changeOs(string $type)
    {
        $this->system = SoRequirementType::from($type)->value;
        session()->put('onboarding_system_'.$this->email, $this->system);
    }

    public function render()
    {
        return view('livewire.digital-onboarding.os-requirements');
    }
}
