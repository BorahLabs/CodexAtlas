<div>
    <x-digitalonboarding.decoration />
    <x-filament::section class="relative"
        heading="You're almost there! Let's setup the repositories"
        description="Follow these steps to get the project up and running."
    >
        <div class="space-y-12">
            @foreach ($this->project->repositories as $repository)
            <div class="prose">
                @foreach ($repository->repositoryInstructions as $i => $instruction)
                <h3>{{ $i + 1 }}. {{ $instruction->title }}</h3>
                {!! Str::markdown($instruction->description) !!}
                @endforeach
            </div>
            @endforeach
        </div>
        <x-digitalonboarding.navigation previous="Back" next="I've got it!" />
        <livewire:digitalonboarding.live-help :project="$project" />
      </x-filament::section>
</div>
