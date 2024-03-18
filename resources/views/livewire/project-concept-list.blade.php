<div>
    <div wire:loading.flex class="flex text-center text-white font-medium text-xl items-center justify-center w-full">
        <div>
            <span class="text-center">
                Loading project concepts...
            </span>
        </div>
    </div>

    <div wire:loading.remove class="flex flex-col space-y-4">
        @foreach ($project->concepts as $concept )
            <button  x-on:click="Livewire.dispatch('openModal', { component: 'add-project-concept', arguments: { concept: '{{$concept->id}}' }})"  class="text-left bg-input-gradient w-full rounded-lg text-white p-[2px]">
                <div class="p-3 bg-body rounded-lg">
                    <span class="font-bold"> {{$concept->name}}:</span>
                    <span>
                        {{$concept->description}}
                    </span>
                </div>
            </button>
        @endforeach
    </div>
</div>
