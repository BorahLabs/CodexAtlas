<div>
    <div wire:loading.flex class="flex text-center text-white font-medium text-xl items-center justify-center w-full">
        <div>
            <span class="text-center">
                Loading project concepts...
            </span>
        </div>
    </div>

    <div wire:loading.remove class="flex flex-col space-y-4">
        @foreach ($project->concepts->sortBy('created_at') as $concept)
            <div class="relative">
                <button
                    x-on:click="Livewire.dispatch('openModal', { component: 'add-project-concept', arguments: { concept: '{{ $concept->id }}' }})"
                    class="text-left bg-input-gradient w-full rounded-lg text-white p-[2px]">
                    <div class="p-3 bg-body rounded-lg flex flex-col items-start justify-start">
                        <div class="flex justify-between items-center w-full">
                            <h4 class="font-bold mb-px text-lg title-gradient"> {{ $concept->name }}</h4>
                        </div>
                        <p class="font-light mt-2">
                            {{ $concept->description }}
                        </p>
                    </div>
                </button>
                <button class="absolute right-4 top-4" wire:click="$dispatch('openModal', { component: 'glossary.delete-confirmation-modal', arguments: { concept: '{{ $concept->id }}' }})">
                    <x-icons.trash class="w-4 h-4" />
                </button>
            </div>
        @endforeach
    </div>
</div>
