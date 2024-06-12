<header class="relative bg-body overflow-hidden">
    <nav class="relative z-20 py-7">
        <div class="container mx-auto px-4">
            <div class="relative flex items-center justify-between">
                <a class="inline-block" href="{{ route('homepage') }}">
                    <x-application-logo :name="true" class="h-10" />
                </a>
                <div x-data="{ showNav: false }" class="flex items-center justify-end">
                    <div class="lg:hidden relative">
                        <button x-on:click="showNav = !showNav"
                            class="inline-flex items-center justify-center p-2 rounded-md text-newGray-500 hover:text-newGray-400 hover:bg-newGray-900 focus:outline-none focus:bg-newGray-900 focus:text-newGray-400 transition duration-150 ease-in-out">
                            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                <path :class="{ 'hidden': showNav, 'inline-flex': !showNav }" class="inline-flex"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16" />
                                <path :class="{ 'hidden': !showNav, 'inline-flex': showNav }" class="hidden"
                                    stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                        <div x-show="showNav"
                            class="bg-dark text-white z-40 flex flex-col space-y-4 text-4xl transition fixed top-0 left-0 w-full h-full overflow-auto md:relative md:w-full md:h-full"
                            x-bind:class="{
                                'pointer-events-none opacity-0 scale-75': !showNav,
                                'opacity-1 scale-100': showNav
                            }"
                            x-bind:tabindex="showNav ? 0 : -1" x-cloak>
                            <button x-on:click="showNav = !showNav"
                                class="self-end rounded-full px-2 py-1 border border-white text-sm mr-4 mt-10 text-white">
                                X
                            </button>
                            <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                                href="{{ route('guide.index') }}">{{ __('Guide') }}</a>
                            <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                                href="{{ route('enterprise') }}">{{ __('Enterprise') }}</a>
                            @guest
                                <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                                    href="{{ route('login') }}">{{ __('Log in') }}</a>
                                @if (Route::has('register'))
                                    <a class="inline-flex h-11 py-2 px-4 mx-8 items-center justify-center text-sm font-medium uppercase text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                        href="{{ route('register') }}">{{ __('Register') }}</a>
                                @endif
                            @else
                                <a class="inline-flex h-11 py-2 px-4 mx-8 items-center justify-center text-sm font-medium uppercase text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                    href="{{ route('dashboard') }}">{{ __('My projects') }}</a>
                            @endguest
                        </div>
                    </div>
                    <div class="hidden lg:block mr-10">
                        <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                            href="{{ route('guide.index') }}">{{ __('Guide') }}</a>
                        <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                            href="{{ route('enterprise') }}">{{ __('Enterprise') }}</a>
                        <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                            href="{{ route('blog.index') }}">{{ __('Blog') }}</a>
                        @guest
                            <a class="inline-flex py-2 px-4 mr-4 items-center justify-center text-sm font-medium uppercase text-white hover:text-violet-500"
                                href="{{ route('login') }}">{{ __('Log in') }}</a>
                            @if (Route::has('register'))
                                <a class="inline-flex h-11 py-2 px-4 items-center justify-center text-sm font-medium uppercase text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <a class="inline-flex h-11 py-2 px-4 items-center justify-center text-sm font-medium uppercase text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                href="{{ route('dashboard') }}">{{ __('My projects') }}</a>
                        @endguest
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
