<?php

namespace App\Livewire\DigitalOnboarding;

use App\Livewire\DigitalOnboarding\Traits\HasNavigation;
use App\Models\Project;
use Livewire\Component;

class GetStarted extends Component
{
    use HasNavigation;

    public Project $project;

    public function render()
    {
        return view('livewire.digital-onboarding.get-started');
    }
}
