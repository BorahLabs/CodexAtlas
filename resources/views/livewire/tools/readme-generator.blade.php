<div>
    <div wire:loading.remove class="{{ $readme ? 'hidden' : '' }}">
        <label
            class="border-2 border-dashed border-darkBlue-700 rounded-xl p-8 flex items-center justify-center flex-col cursor-pointer hover:bg-darkBlue-800 transition">
            <input type="file" wire:model.live="zip" class="sr-only" />
            <svg class="h-16 w-16 text-white" fill="none" stroke-width="1.5" stroke="currentColor" viewBox="0 0 24 24"
                xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 16.5V9.75m0 0 3 3m-3-3-3 3M6.75 19.5a4.5 4.5 0 0 1-1.41-8.775 5.25 5.25 0 0 1 10.233-2.33 3 3 0 0 1 3.758 3.848A3.752 3.752 0 0 1 18 19.5H6.75Z">
                </path>
            </svg>
            <span class="block text-center text-white mt-8">
                Upload a zip file of your code
            </span>
        </label>
        <x-input-error for="zip" class="mt-2" />
    </div>
    <div wire:loading.flex class="justify-center items-center">
        <x-filament::loading-indicator class="h-20 w-20" />
    </div>
    @if ($readme)
        <h2 class="font-bold text-lg mb-4">README.md</h2>
        <div class="prose prose-invert max-w-none w-full">
            {!! Str::markdown($readme) !!}
        </div>

        <div class="flex justify-center items-center space-x-4 mt-8">
            <x-button theme="primary" wire:click="download">Download</x-button>
            <span>or</span>
            <x-button theme="default" wire:click="$set('readme', null)">Start again</x-button>
        </div>
    @endif
</div>
