<div class="w-full">
    <form wire:submit="convert" class="w-full flex flex-col justify-center items-center {{ $result ? 'hidden' : '' }}"
        wire:loading.remove>
        <textarea wire:model="code" class="bg-slate-800 text-white border border-slate-700 rounded-xl w-full resize-none"
            placeholder="Your {{ $from }} code goes here" rows="15"></textarea>
        @error('code')
            <div class="text-red-500 w-full mt-1">{{ $message }}</div>
        @enderror
        <x-button theme="primary" class="mt-8">Convert</x-button>
    </form>

    <div wire:loading.flex wire:target="convert" class="justify-center items-center">
        <x-filament::loading-indicator class="h-20 w-20" />
    </div>
    @if ($result)
        <h2 class="font-bold text-lg mb-4">Result</h2>
        <div class="prose prose-invert max-w-none w-full">
            {!! Str::markdown($result) !!}
        </div>
        <x-button theme="primary" class="mt-8" wire:click="$set('result', null)">Start again</x-button>
    @endif
</div>
