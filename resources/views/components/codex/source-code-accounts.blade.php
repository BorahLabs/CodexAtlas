<div x-modelable="selected" x-data="{ selected: '{{ $accounts->first()?->id }}', isAdding: {{ session()->has('provider') || $accounts->isEmpty() ? 'true' : 'false' }}, provider: {{ session()->has('provider') ? "'" . session('provider') . "'" : 'null' }} }" {{ $attributes }} x-cloak>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
        <!-- When listing accounts -->
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
            x-on:click="isAdding = true; provider = null">
            <x-codex.icons.plus class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add new account') }}</p>
        </button>

        <!-- When adding a new account -->
        <a href="{{ route('github.redirect') }}" x-show="isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center text-center items-center space-y-4 hover:border-violet-500"
            x-on:click="provider = null">
            <x-codex.icons.github class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add GitHub account') }}</p>
        </a>
        <button type="button" x-show="isAdding"
            class="border rounded-md p-4 flex flex-col justify-center items-center space-y-4"
            x-bind:class="{
                'border-slate-600 hover:border-violet-500': provider !== 'gitlab',
                'border-violet-500': provider === 'gitlab',
            }"
            x-on:click="provider = 'gitlab'">
            <x-codex.icons.gitlab class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add Gitlab account') }}</p>
        </button>
        <button type="button" x-show="isAdding"
            class="border rounded-md p-4 flex flex-col justify-center items-center space-y-4"
            x-bind:class="{
                'border-slate-600 hover:border-violet-500': provider !== 'bitbucket',
                'border-violet-500': provider === 'bitbucket',
            }"
            x-on:click="provider = 'bitbucket'">
            <x-codex.icons.bitbucket class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Add Bitbucket account') }}</p>
        </button>
        <button type="button" x-show="isAdding"
            class="border border-slate-600 rounded-md p-4 flex flex-col justify-center items-center space-y-4 hover:border-violet-500"
            x-on:click="isAdding = false; provider = null">
            <x-codex.icons.cancel class="h-12 w-12 text-slate-700" />
            <p class="text-slate-300 font-bold text-sm">{{ __('Cancel') }}</p>
        </button>
        <div x-show="provider !== null" class="col-span-1 sm:col-span-2 md:col-span-4">
            <form action="{{ route('source-code-accounts.pat.store') }}" method="POST">
                @csrf
                <input type="hidden" name="provider" x-model="provider" />
                <x-label for="pat-user">{{ __('Username') }}</x-label>
                <x-input id="pat-user" type="text" class="mt-1 block w-full" name="username" required />
                <x-input-error for="username" />
                <x-label for="pat" class="mt-4">{{ __('App token') }}</x-label>
                <x-input id="pat" type="text" class="mt-1 block w-full" name="pat" required />
                <x-input-error for="pat" />
                <p x-show="provider === 'gitlab'" class="text-sm text-slate-300 mt-2">
                    You can generate a Personal Access Token for Gitlab <a
                        href="https://gitlab.com/-/user_settings/personal_access_tokens" target="_blank"
                        class="underline">here</a>. Make sure to select the <strong>api</strong> scope.
                </p>
                <p x-show="provider === 'bitbucket'" class="text-sm text-slate-300 mt-2">
                    You can generate an App Password for Bitbucket <a
                        href="https://bitbucket.org/account/settings/app-passwords/" target="_blank"
                        class="underline">here</a>. Make sure to select the <strong>Read</strong> permissions in
                    <strong>Account and Repositories</strong>, and <strong>Read and write</strong> in
                    <strong>Webhooks</strong>.
                </p>
                <x-button type="submit" class="mt-4">{{ __('Add account') }}</x-button>
            </form>
        </div>
    </div>
</div>
