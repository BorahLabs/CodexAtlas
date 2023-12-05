<div x-modelable="selected" x-data="{ selected: '{{ $accounts->first()?->id }}', isAdding: false }" {{ $attributes }}>
    <div class="grid grid-cols-4 gap-8">
        @foreach ($accounts as $account)
            <button type="button"
                class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
                x-bind:class="{
                    'border-slate-600 hover:border-violet-500': selected !== '{{ $account->id }}',
                    'border-violet-500': selected === '{{ $account->id }}',
                }"
                x-on:click="selected = '{{ $account->id }}'" x-show="!isAdding">
                <x-dynamic-component :component="$account->getProvider()->icon()" class="h-12 w-12"
                    x-bind:class="{
                        'text-slate-700': selected !== '{{ $account->id }}',
                        'text-slate-200': selected === '{{ $account->id }}',
                    }" />
                <h2 class="text-slate-300 font-bold text-sm">{{ $account->name }}</h2>
            </button>
        @endforeach
        <button type="button" x-show="!isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
            x-on:click="isAdding = true">
            <x-codex.icons.plus class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add new account') }}</p>
        </button>
        <a href="{{ route('github.redirect') }}" x-show="isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
            x-on:click="isAdding = true">
            <x-codex.icons.github class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add GitHub account') }}</p>
        </a>
        <a href="{{ route('gitlab.redirect') }}" x-show="isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
            x-on:click="isAdding = true">
            <x-codex.icons.gitlab class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add Gitlab account') }}</p>
        </a>
        <a href="{{ route('bitbucket.redirect') }}" x-show="isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
            x-on:click="isAdding = true">
            <x-codex.icons.bitbucket class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add Bitbucket account') }}</p>
        </a>
        <button type="button" x-show="isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
            x-on:click="isAdding = false">
            <x-codex.icons.cancel class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Cancel') }}</p>
        </button>
    </div>
</div>
