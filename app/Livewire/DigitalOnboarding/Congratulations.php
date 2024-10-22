<?php

namespace App\Livewire\DigitalOnboarding;

use App\Livewire\DigitalOnboarding\Traits\HasNavigation;
use App\Models\Project;
use Livewire\Component;

class Congratulations extends Component
{
    use HasNavigation;

    public Project $project;

    public function render()
    {
        return view('livewire.digital-onboarding.congratulations');
    }

    public function next()
    {
        $this->dispatch('restart');
    }
}
