<div class="w-full">
    <form wire:submit="sendCode" class="w-full flex flex-col justify-center items-center" wire:loading.remove
        wire:target="sendCode">
        <div class="grid grid-cols-2 w-full gap-y-10 gap-x-4 items-center justify-center text-center">
            <div>
                <h2 class="font-bold text-3xl text-primary-gradient text-center mt-4">
                    Add your code here
                </h2>
            </div>
            <div>
                <h2 class="font-bold text-3xl text-primary-gradient text-center mt-4">
                    Explain your error
                </h2>
            </div>
            <div class="w-full">
                <x-bordered-textarea wire:model.live="code" id="code" type="text" class="block w-full h-64"
                    name="code" />
                @error('code')
                    <p class="text-red-400 mt-4 text-center">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <x-bordered-textarea wire:model.live="codeError" id="codeError" type="text" class="block w-full h-64"
                    name="codeError" />
                @error('codeError')
                    <p class="text-red-400 mt-4 text-center">{{ $message }}</p>
                @enderror
            </div>
        </div>

        @error('limit')
            <p class="text-red-400 mt-4 text-center">{{ $message }}</p>
        @enderror

        <div class="w-full flex justify-center mt-10">
            <x-button theme="primary" type="submit">Send code</x-button>
        </div>
    </form>

    <div wire:loading.flex wire:target="sendCode" class="justify-center items-center">
        <x-filament::loading-indicator class="h-20 w-20" />
    </div>

    @if ($solution)
        <div wire:loading.remove wire:target="sendCode" class="w-full mt-10">
            <h2 class="font-bold text-4xl text-primary-gradient text-left mt-4 mb-2">
                Result
            </h2>
            <pre class="w-full overflow-auto"><code>{{ str($solution)->trim('`') }}</code></pre>
        </div>
    @endif
</div>
