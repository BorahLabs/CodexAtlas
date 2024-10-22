<x-filament::section>
    <img src="{{ asset('digitalonboarding/grow.png') }}" alt="Let's grow together" class="max-h-[20rem] w-auto mx-auto" />
    <div class="prose mx-auto text-center mt-12">
        <h1 class="modak">
            Welcome!
        </h1>
        <p>
            Please, introduce your email so we can track your onboarding progress.
        </p>
    </div>
    <form wire:submit="submit">
        <div class="max-w-lg mx-auto bg-gray-50 p-4 rounded-md mt-4">
            {{ $this->form }}
        </div>
        <div class="flex justify-center mt-8">
            <x-filament::button type="submit" color="primary" size="xl" icon="heroicon-m-arrow-right" iconPosition="after">
                Get started
            </x-filament::button>
        </div>
    </form>
</x-filament::section>
