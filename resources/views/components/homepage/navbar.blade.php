<header class="relative bg-body overflow-hidden">
    <nav class="relative z-10 py-7">
        <div class="container mx-auto px-4">
            <div class="relative flex items-center justify-between">
                <a class="inline-block" href="{{ route('homepage') }}">
                    <x-application-logo :name="true" class="h-10" />
                </a>
                <div class="flex items-center justify-end">
                    <div class="hidden lg:block mr-10">
                        <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                            href="{{ route('login') }}">{{ __('Log in') }}</a>
                        <a class="inline-flex h-11 py-2 px-4 items-center justify-center text-sm font-medium uppercase text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                            href="{{ route('register') }}">{{ __('Register') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
