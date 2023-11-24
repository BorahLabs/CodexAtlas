<div x-modelable="selected" x-data="{ selected: '{{ $accounts->first()?->id }}' }" {{ $attributes }}>
    <div class="grid grid-cols-4 gap-8">
        @foreach ($accounts as $account)
            <button type="button"
                class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
                x-bind:class="{
                    'border-slate-600 hover:border-violet-500': selected !== '{{ $account->id }}',
                    'border-violet-500': selected === '{{ $account->id }}',
                }"
                x-on:click="selected = '{{ $account->id }}'">
                <x-dynamic-component :component="$account->getProvider()->icon()" class="h-12 w-12"
                    x-bind:class="{
                        'text-slate-700': selected !== '{{ $account->id }}',
                        'text-slate-200': selected === '{{ $account->id }}',
                    }" />
                <h2 class="text-slate-300 font-bold text-sm">{{ $account->name }}</h2>
            </button>
        @endforeach
        <a href="#"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500">
            <x-codex.icons.plus class="h-12 w-12 text-slate-700" />
            <h2 class="text-slate-300 font-bold text-sm">{{ __('Add new account') }}</h2>
        </a>
    </div>
</div>
