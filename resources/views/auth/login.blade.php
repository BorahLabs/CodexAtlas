<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                    autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-newGray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-center mt-2">
                <x-button class="flex justify-center w-2/5 text-center">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>

        <div class="flex items-center mt-2">
            <div class="h-px bg-newGray-500 w-full"></div>
            <span class="mx-2 text-center">o</span>
            <div class="h-px bg-newGray-500 w-full"></div>
        </div>

        <div class="mt-4 flex space-x-2">
            <x-codex.login-google />
            <x-codex.login-github />
        </div>

        @if (Route::has('password.request'))
            <div class="w-full flex justify-center mt-8">
                <a class="underline text-sm text-newGray-400 hover:text-newGray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-violet-500 focus:ring-offset-newGray-800"
                    href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            </div>
        @endif
    </x-authentication-card>
</x-guest-layout>
