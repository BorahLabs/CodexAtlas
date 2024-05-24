<div>
    <svg width="717" height="325" viewBox="0 0 717 325" fill="none" xmlns="http://www.w3.org/2000/svg"
        class="absolute left-0 top-0 pointer-events-none">
        <g style="mix-blend-mode:screen" filter="url(#filter0_f_302_4569)">
            <path
                d="M92.4775 219.778C221.406 -144.845 498.947 -317.963 568.565 -366L-318.917 -91.2611L-188.381 688.223C2.50826 644.338 -29.3561 564.337 92.4775 219.778Z"
                fill="url(#paint0_radial_302_4569)" fill-opacity="0.3" />
        </g>
        <defs>
            <filter id="filter0_f_302_4569" x="-467.12" y="-514.202" width="1183.89" height="1350.63"
                filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                <feFlood flood-opacity="0" result="BackgroundImageFix" />
                <feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
                <feGaussianBlur stdDeviation="74.1009" result="effect1_foregroundBlur_302_4569" />
            </filter>
            <radialGradient id="paint0_radial_302_4569" cx="0" cy="0" r="1"
                gradientUnits="userSpaceOnUse"
                gradientTransform="translate(333.433 135.214) rotate(-150.409) scale(509.522 509.537)">
                <stop offset="0.409332" stop-color="#6041FF" />
                <stop offset="1" stop-opacity="0" />
                <stop offset="1" stop-color="#2D2E32" stop-opacity="0" />
            </radialGradient>
        </defs>
    </svg>

    <div class="relative">
        <div x-modelable="selected" x-data="{
            selected: '{{ $accounts->first()?->id }}',
            isAdding: {{ session()->has('provider') || $accounts->isEmpty() ? 'true' : 'false' }},
            provider: {{ session()->has('provider') ? "'" . session('provider') . "'" : 'null' }}
        }" {{ $attributes }} x-cloak>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                <!-- When listing accounts -->
                @foreach ($accounts as $account)
                    <x-bordered-black-box :single="true" innerClass="flex w-full overflow-hidden" x-show="!isAdding">
                        <div class="w-full bg-black rounded-xl"
                            style="background-image: url('{{ asset('images/source-provider-card-bd.png') }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                            <button type="button"
                                class="rounded-md p-4 flex flex-col justify-center items-center space-y-4 w-full hover:border-violet-500"
                                x-data="{ enabled: () => '{{ $account->id }}' === selected }" x-on:click="selected = '{{ $account->id }}'">
                                <x-dynamic-component x-data="{ active: enabled }" :component="$account->getProvider()->circledClearGradientIcon()" class="h-16 w-16" />
                                <span class="font-medium"
                                    x-bind:class="enabled() ? 'text-white-gradient' : 'text-[#222564]'">{{ $account->name }}</span>
                            </button>
                        </div>
                    </x-bordered-black-box>
                @endforeach

                <x-bordered-black-box :single="true" innerClass="flex w-full overflow-hidden" x-show="!isAdding">
                    <div class="w-full bg-black rounded-xl"
                        style="background-image: url('{{ asset('images/source-provider-card-bd.png') }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <button type="button"
                            class="rounded-md p-4 flex flex-col justify-center items-center space-y-4 w-full hover:border-violet-500"
                            x-data="{ enabled: () => isAdding }"
                            x-on:click="isAdding = true; provider = null; $dispatch('source-code-add')">
                            <x-codex.icons.plus x-data="{ active: enabled }" class="h-16 w-16" />
                            <span class="font-medium text-[#222564]">{{ __('Add account') }}</span>
                        </button>
                    </div>
                </x-bordered-black-box>

                <!-- When adding a new account -->
                <x-bordered-black-box :single="true" innerClass="flex w-full overflow-hidden" x-show="isAdding">
                    <div class="w-full bg-black rounded-xl"
                        style="background-image: url('{{ asset('images/source-provider-card-bd.png') }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <a href="{{ route('github.redirect') }}"
                            class="rounded-md p-4 flex flex-col justify-center items-center space-y-4 w-full hover:border-violet-500 text-center"
                            x-data="{ enabled: () => provider === 'github' || provider === null }">
                            <x-codex.icons.github-circle-clear-gradient x-data="{ active: enabled }" class="h-16 w-16" />
                            <span class="font-medium"
                                x-bind:class="enabled() ? 'text-white-gradient' : 'text-[#222564]'">{{ __('Add GitHub account') }}</span>
                        </a>
                    </div>
                </x-bordered-black-box>
                <x-bordered-black-box :single="true" innerClass="flex w-full overflow-hidden" x-show="isAdding">
                    <div class="w-full bg-black rounded-xl"
                        style="background-image: url('{{ asset('images/source-provider-card-bd.png') }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <button type="button"
                            class="rounded-md p-4 flex flex-col justify-center items-center space-y-4 w-full hover:border-violet-500 text-center"
                            x-data="{ enabled: () => provider === 'gitlab' }" x-on:click="provider = 'gitlab'">
                            <x-codex.icons.gitlab-circle-clear-gradient x-data="{ active: enabled }" class="h-16 w-16" />
                            <span class="font-medium"
                                x-bind:class="enabled() ? 'text-white-gradient' : 'text-[#222564]'">{{ __('Add Gitlab account') }}</span>
                            </a>
                    </div>
                </x-bordered-black-box>
                <x-bordered-black-box :single="true" innerClass="flex w-full overflow-hidden" x-show="isAdding">
                    <div class="w-full bg-black rounded-xl"
                        style="background-image: url('{{ asset('images/source-provider-card-bd.png') }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <button type="button"
                            class="rounded-md p-4 flex flex-col justify-center items-center space-y-4 w-full hover:border-violet-500 text-center"
                            x-data="{ enabled: () => provider === 'bitbucket' }" x-on:click="provider = 'bitbucket'">
                            <x-codex.icons.bitbucket-circle-clear-gradient x-data="{ active: enabled }" class="h-16 w-16" />
                            <span class="font-medium"
                                x-bind:class="enabled() ? 'text-white-gradient' : 'text-[#222564]'">{{ __('Add Bitbucket account') }}</span>
                            </a>
                    </div>
                </x-bordered-black-box>
                <x-bordered-black-box :single="true" innerClass="flex w-full overflow-hidden" x-show="isAdding">
                    <div class="w-full bg-black rounded-xl"
                        style="background-image: url('{{ asset('images/source-provider-card-bd.png') }}'); background-position: center; background-size: cover; background-repeat: no-repeat;">
                        <button type="button"
                            class="rounded-md p-4 flex flex-col justify-center items-center space-y-4 w-full hover:border-violet-500"
                            x-data="{ enabled: () => !isAdding }"
                            x-on:click="isAdding = false; provider = null; $dispatch('source-code-cancel')">
                            <x-codex.icons.cancel x-data="{ active: enabled }" class="h-16 w-16" />
                            <span class="font-medium text-[#222564]">{{ __('Cancel') }}</span>
                        </button>
                    </div>
                </x-bordered-black-box>
                <div x-show="provider !== null" class="col-span-1 sm:col-span-2 md:col-span-4">
                    <form action="{{ route('source-code-accounts.pat.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="provider" x-model="provider" />
                        <x-label style="lightweight" for="pat-user" class="mb-2">{{ __('Username') }}</x-label>
                        <x-bordered-input id="pat-user" type="text" class="block w-full" name="username"
                            required />
                        <x-input-error for="username" />
                        <x-label style="lightweight" for="pat"
                            class="mt-4 mb-2">{{ __('App token') }}</x-label>
                        <x-bordered-input id="pat" type="text" class="block w-full" name="pat"
                            required />
                        <x-input-error for="pat" />
                        <p x-show="provider === 'gitlab'" class="text-sm text-slate-300 mt-2">
                            You can generate a Personal Access Token for Gitlab <a
                                href="https://gitlab.com/-/user_settings/personal_access_tokens" target="_blank"
                                class="underline">here</a>. Make sure to select the <strong>api</strong> scope.
                        </p>
                        <p x-show="provider === 'bitbucket'" class="text-sm text-slate-300 mt-2">
                            You can generate an App Password for Bitbucket <a
                                href="https://bitbucket.org/account/settings/app-passwords/" target="_blank"
                                class="underline">here</a>. Make sure to select the <strong>Read</strong> permissions
                            in
                            <strong>Account and Repositories</strong>, and <strong>Read and write</strong> in
                            <strong>Webhooks</strong>.
                        </p>
                        <x-button theme="primary" type="submit" class="mt-4">{{ __('Add account') }}</x-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
