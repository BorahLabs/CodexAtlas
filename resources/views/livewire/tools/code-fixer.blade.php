<div class="w-full">
    <div class="grid grid-cols-2 w-full gap-y-10 gap-x-4 items-center justify-center text-center">
        <div>
            <h2 class="font-bold text-3xl text-primary-gradient text-center mt-4">
                Code
            </h2>
        </div>
        <div>
            <h2 class="font-bold text-3xl text-primary-gradient text-center mt-4">
                Error
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
        <x-button wire:click="sendCode" theme="primary" type="submit">Send code</x-button>
    </div>

    @if ($solution)
        <div class="w-full mt-10">
            <h2 class="font-bold text-4xl text-primary-gradient text-left mt-4 mb-2">
                Result
            </h2>
            <pre><code>{{ (string) $solution }}</code></pre>
        </div>
    @endif
</div>
