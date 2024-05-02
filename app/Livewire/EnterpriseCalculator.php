<?php

namespace App\Livewire;

use App\Actions\InternalNotifications\LogUserPerformedAction;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;
use Livewire\Component;
use Symfony\Contracts\Service\Attribute\Required;

class EnterpriseCalculator extends Component
{
    #[Required]
    public int|float|null $devPricePerHour = 20;
    #[Required]
    public int|null $numberOfDevs = 4;
    #[Required]
    public int|null $numberOfProjects = 10;
    #[Required]
    public int $documentationReadiness = 1;

    #[Locked]
    public int $averageFileChangesPerDay = 15;

    #[Rule(['required', 'email:rfc,dns'])]
    public string $companyEmail = '';

    public bool $demoScheduled = false;

    #[Computed]
    public function minDocumentationCost()
    {
        return max($this->numberOfDevs, 1) * max($this->devPricePerHour, 1) * 160 * 0.1 * 11;
    }

    #[Computed]
    public function maxDocumentationCost()
    {
        return max($this->numberOfDevs, 1) * max($this->devPricePerHour, 1) * 160 * 0.2 * 11;
    }

    #[Computed]
    public function setupComputer()
    {
        return match ($this->documentationReadiness) {
            2 => [
                'name' => 'Mac Studio M2 Max GPU 30 núcleos',
                'price' => 3000,
            ],
            3 => [
                'name' => 'Mac Studio M2 Ultra GPU 60 núcleos',
                'price' => 5500,
            ],
            default => [
                'name' => 'Mac Mini M2 Pro GPU 10 núcleos',
                'price' => 2000,
            ],
        };
    }

    #[Computed]
    public function expectedFileChangesPerDay()
    {
        return $this->numberOfProjects * $this->averageFileChangesPerDay * $this->numberOfDevs;
    }

    #[Computed]
    public function price()
    {
        $systemLoadFactor = match(true) {
            $this->expectedFileChangesPerDay > 2000 => 7,
            $this->expectedFileChangesPerDay > 1000 => 5.5,
            $this->expectedFileChangesPerDay > 500 => 4.3,
            $this->expectedFileChangesPerDay > 200 => 3,
            $this->expectedFileChangesPerDay > 100 => 2.3,
            $this->expectedFileChangesPerDay > 50 => 2,
            $this->expectedFileChangesPerDay > 20 => 1.8,
            default => 1.5,
        };

        $documentationReadinessFactor = match($this->documentationReadiness) {
            2 => 1.1,
            3 => 1.3,
            default => 1,
        };

        return max(8000, $this->setupComputer['price'] + 2000 * $systemLoadFactor * $documentationReadinessFactor);
    }

    public function askForDemoCall()
    {
        if ($this->demoScheduled) {
            return;
        }

        $this->validate();

        LogUserPerformedAction::dispatch(
            \App\Enums\Platform::Codex,
            \App\Enums\NotificationType::DemoCall,
            '**DEMO CALL REQUEST** requested by ' . $this->companyEmail . ' @everyone',
            [
                'Email' => $this->companyEmail,
                'Number of devs' => $this->numberOfDevs,
                'Number of projects' => $this->numberOfProjects,
                'Computer setup' => $this->setupComputer['name'],
                'Estimated price' => number_format($this->price, 0, ',', '.').'€',
            ],
        );
        $this->demoScheduled = true;
    }

    public function render()
    {
        return view('livewire.enterprise-calculator');
    }
}
