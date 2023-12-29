<x-web-layout>
    <div class="py-32 flex flex-col sm:justify-center items-center">
        <div class="w-full sm:max-w-md mt-6 px-6 py-4 overflow-hidden sm:rounded-lg relative">
            <form method="POST" action="{{ route('password-protected') }}">
                @csrf

                <div class="mt-4">
                    <x-label for="secret" value="{{ __('Secret') }}" />
                    <x-input id="secret" class="block mt-1 w-full" autofocus type="password" name="secret" required />
                </div>

                @if (session('error'))
                    <div class="mb-4 font-medium text-sm text-red-400">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="flex items-center justify-end mt-4">
                    <x-button class="ms-4">
                        {{ __('Log in') }}
                    </x-button>
                </div>
            </form>
        </div>
    </div>
</x-web-layout>
