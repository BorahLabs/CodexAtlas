<div>
    @if (!$systemComponent)
        <h2 class="text-2xl font-bold text-center">Upload a {{ $lang->name() }} file to get started</h2>
        <div class="text-center mt-8">
            <label
                class="inline-flex items-center px-4 py-3 bg-violet-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-violet-500 focus:bg-violet-700 active:bg-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-violet-700 transition ease-in-out duration-150 cursor-pointer">
                <x-codex.icons.plus class="h-4 w-4 mr-4" />
                <span>Click here to upload your file</span>
                <input type="file" class="sr-only" wire:model="file">
            </label>
            @error('file')
                <p class="text-red-400 mt-4 text-center">{{ $message }}</p>
            @enderror
            <p class="text-slate-400 text-sm mt-12">
                <svg class="text-slate-500 h-4 w-4 inline" fill="none" stroke-width="1.5" stroke="currentColor"
                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z">
                    </path>
                </svg>
                Your privacy is <span class="text-violet-500 font-bold">protected</span>. Your code is not stored or
                used
                for any
                logging or training purposes. It will be shared with OpenAI and deleted afterwards.
            </p>
        </div>
    @else
        <h2 class="text-2xl font-bold text-center">{{ $systemComponent->name }} documentation</h2>
        <div class="prose" wire:poll.5s>
            @if ($systemComponent->markdown_docs)
                {!! Str::markdown($systemComponent->markdown_docs) !!}
            @endif
        </div>
    @endif
</div>
