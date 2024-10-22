<div>
    <x-digitalonboarding.decoration />
    <x-filament::section class="relative"
        heading="Let's get you setup"
        description="Follow these steps to prepare your system to run the project."
    >
        <x-filament::tabs label="Operating System">
            @foreach (\App\Enums\SoRequirementType::cases() as $os)
            @if($this->project->requirementsFor($os))
            <x-filament::tabs.item :icon="$os->getIcon()" :active="$os->value == $system" wire:click="changeOs('{{ $os->value }}')">
                {{ $os->getLabel() }}
            </x-filament::tabs.item>
            @endif
            @endforeach
        </x-filament::tabs>
        @if ($this->project->requirementsFor(\App\Enums\SoRequirementType::from($system)))
        <div class="prose mt-12">
            @foreach ($this->project->requirementsFor(\App\Enums\SoRequirementType::from($system)) as $i => $requirement)
            <h3>{{ $i + 1 }}. {{ $requirement['title'] }}</h3>
            {!! Str::markdown($requirement['description']) !!}
            @if (filled($requirement['links']))
            <ul>
                @foreach ($requirement['links'] as $link)
                <li><a href="{{ $link }}" target="_blank">{{ parse_url($link, PHP_URL_HOST) }}</a></li>
                @endforeach
            </ul>
            @endif
            @endforeach
        </div>
        @endif
        <x-digitalonboarding.navigation previous="Back" next="Done! Continue" />
        <livewire:digitalonboarding.live-help :project="$project" />
      </x-filament::section>
</div>
