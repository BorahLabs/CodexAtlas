<?php

namespace App\Livewire\DigitalOnboarding;

use App\Models\Project;
use App\Models\ProjectConcept;
use App\Models\VdsLead;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class OnboardingFlow extends Component
{
    public Project $project;

    #[Url(keep: true)]
    public int $step = 0;

    #[Url(keep: true)]
    public ?string $email = null;

    public function mount()
    {
        if ($this->email) {
            $status = session()->get('onboarding_'.$this->email);
            if ($this->step === 0) {
                $this->step = $status['step'] ?? 0;
            }
        } else {
            $this->step = 0;
        }
    }

    public function render()
    {
        return view('livewire.digital-onboarding.onboarding-flow');
    }

    #[On('set-email')]
    public function setEmail(string $email)
    {
        $this->email = $email;
        VdsLead::create([
            'email' => $email,
        ]);

        $currentSession = session()->get('onboarding_'.$this->email);
        if ($currentSession) {
            $this->step = $currentSession['step'] ?? 0;
            if ($this->step === 0) {
                $this->next();
            }
        } else {
            session()->put('onboarding_'.$this->email, [
                'step' => 0,
            ]);
            $this->next();
        }
    }

    #[On('next-step')]
    public function next()
    {
        switch ($this->step) {
            case 0:
                if ($this->email) {
                    $this->step += 1;
                }
                break;
            case 1:
                if ($this->project->concepts->isEmpty()) {
                    $this->step += 2;
                } else {
                    $this->step += 1;
                }
                break;
            default:
                $this->step += 1;
        }

        $currentSession = session()->get('onboarding_'.$this->email);
        session()->put('onboarding_'.$this->email, [
            ...($currentSession ?? []),
            'step' => $this->step,
        ]);
    }

    #[On('previous-step')]
    public function previous()
    {
        switch ($this->step) {
            case 3:
                if ($this->project->concepts->isEmpty()) {
                    $this->step -= 2;
                } else {
                    $this->step -= 1;
                }
                break;
            default:
                $this->step -= 1;
        }

        $currentSession = session()->get('onboarding_'.$this->email);
        session()->put('onboarding_'.$this->email, [
            ...($currentSession ?? []),
            'step' => $this->step,
        ]);
    }

    #[On('restart')]
    public function restart()
    {
        $this->step = 0;
        $this->email = null;
    }
}
