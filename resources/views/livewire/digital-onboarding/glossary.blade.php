<div>
    <x-digitalonboarding.decoration />
    <x-filament::section class="relative"
        heading="Some things you need to know"
        description="Before we get started, there are a few important things about our business that you need to understand. This will help you get up to speed in record time.">

        <div class="prose">
            @foreach ($this->project->concepts as $concept)
                <h3>{{ $concept->name }}</h3>
                <p>{{ $concept->description }}</p>
            @endforeach
        </div>
        <x-digitalonboarding.navigation previous="Back" next="Continue" />
      </x-filament::section>
</div>
