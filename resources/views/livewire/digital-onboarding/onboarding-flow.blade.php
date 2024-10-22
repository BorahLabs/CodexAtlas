<div>
    @if ($step === 0)
    <livewire:digital-onboarding.welcome :project="$project" />
    @elseif ($step === 1)
    <livewire:digital-onboarding.get-started :project="$project" />
    @elseif ($step === 2)
    <livewire:digital-onboarding.glossary :project="$project" />
    @elseif ($step === 3)
    <livewire:digital-onboarding.os-requirements :project="$project" />
    @elseif ($step === 4)
    <livewire:digital-onboarding.repository-installation :project="$project" />
    @elseif ($step >= 5)
    <livewire:digital-onboarding.congratulations :project="$project" />
    @endif
</div>
