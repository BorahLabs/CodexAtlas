<x-web-layout>
    @section('title', 'Code documentation automated with AI | CodexAtlas')
    <div class="relative pt-24 lg:pt-44 pb-40 lg:pb-72">
        <div class="relative z-10 container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="max-w-lg mx-auto lg:max-w-6xl text-center">
                    <h1
                        class="font-heading text-4xl sm:text-6xl md:text-6xl xl:text-[5rem] text-white font-semibold leading-none mb-8">
                        Create code documentation using AI</h1>
                    <p class="text-2xl text-newGray-400 mb-8">
                        <span class="block">Connect CodexAtlas to your GitHub, Gitlab or Bitbucket accounts</span>
                        <span class="block">and keep your documentation always up-to-date.</span>
                    </p>
                    <div
                        class="flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        @if (paymentIsWithAws())
                            <a class="w-full group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full sm:w-auto"
                                href="{{ config('codex.aws_marketplace_link') }}">
                                <span class="mr-2">{{ __('Sign up with AWS') }}</span>
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <a class="w-full group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white border border-white hover:text-violet-500 bg-transparent hover:bg-white transition duration-200 rounded-full sm:w-auto"
                                href="{{ route('register') }}">
                                <span class="mr-2">{{ __('Try it for free') }}</span>
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                        @else
                            @if (Route::has('register'))
                                <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                    href="{{ route('register') }}">
                                    <span class="mr-2">{{ __('Try it for free') }}</span>
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <img class="absolute bottom-0 left-0 w-full" src="{{ asset('casper-assets/headers/bg-bottom-lines.png') }}"
            alt="">
    </div>

    <section class="relative py-12 md:py-24 bg-body overflow-hidden">
        <img class="absolute bottom-0 right-0" src="{{ asset('casper-assets/features/double-line-circle.svg') }}"
            alt="">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute bottom-0 left-0 -mb-20 w-160 h-160 bg-gradient-to-t from-purple-700 to-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div
                class="absolute bottom-0 right-0 -mb-20 w-148 h-148 bg-gradient-to-t from-violet-900 to-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div class="relative">
                <div class="max-w-xl mx-auto mb-16 text-center">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        Spend more time developing</h2>
                    <p class="text-xl text-newGray-400">CodexAtlas reduces 99% of the manual work on documenting
                        software
                        projects by using the latest advancements in Artificial Intelligence.</p>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                        <div
                            class="max-w-md mx-auto h-full p-8 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-10">
                            <div class="flex mb-12 items-center">
                                <div
                                    class="flex-shrink-0 flex mr-4 items-center justify-center w-16 h-16 rounded-full bg-green-500">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M11.6799 16.9298L15.7499 20.9998L17.5399 19.2098C17.6441 19.106 17.7241 18.9805 17.7743 18.8422C17.8244 18.7039 17.8434 18.5563 17.8299 18.4098L17.1799 11.2998"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M9.36994 4.71L7.99994 6.13M9.36994 17.46C9.4629 17.5537 9.5735 17.6281 9.69536 17.6789C9.81722 17.7297 9.94793 17.7558 10.0799 17.7558C10.212 17.7558 10.3427 17.7297 10.4645 17.6789C10.5864 17.6281 10.697 17.5537 10.7899 17.46L18.6999 9.55C20.1713 8.07754 20.9984 6.08157 20.9999 4C20.9999 3.73478 20.8946 3.48043 20.707 3.29289C20.5195 3.10536 20.2652 3 19.9999 3C17.9184 3.00151 15.9224 3.82867 14.4499 5.3L6.53994 13.21C6.44621 13.303 6.37182 13.4136 6.32105 13.5354C6.27028 13.6573 6.24414 13.788 6.24414 13.92C6.24414 14.052 6.27028 14.1827 6.32105 14.3046C6.37182 14.4264 6.44621 14.537 6.53994 14.63L9.36994 17.46ZM17.8699 16L19.2899 14.59L17.8699 16Z"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                        <path
                                            d="M12.75 6.82022L5.59 6.17022C5.44353 6.15675 5.2959 6.17575 5.15761 6.22588C5.01933 6.27601 4.89381 6.35602 4.79 6.46022L3 8.25022L7.09 12.3402"
                                            stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-medium text-white leading-tight">
                                        <span class="block">Seamless</span>
                                        <span>Integration</span>
                                    </h4>
                                </div>
                            </div>
                            <p class="text-xl text-newGray-400">Powered by state-of-the-art artificial intelligence,
                                ensuring the right understanding for your code.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                        <div
                            class="max-w-md mx-auto h-full p-8 rounded-3xl shadow-box-orange overflow-hidden bg-white bg-opacity-10">
                            <div class="flex mb-12 items-center">
                                <div
                                    class="flex-shrink-0 flex mr-4 items-center justify-center w-16 h-16 rounded-full bg-yellow-700">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M3 3V2C2.44772 2 2 2.44772 2 3H3ZM18.293 14.293L17.3818 13.8809C17.2104 14.2601 17.2916 14.7058 17.5859 15.0001L18.293 14.293ZM21 17L21.7071 17.7071C22.0976 17.3166 22.0976 16.6834 21.7071 16.2929L21 17ZM17 21L16.2929 21.7071C16.6834 22.0976 17.3166 22.0976 17.7071 21.7071L17 21ZM14.293 18.293L15.0001 17.5859C14.7058 17.2916 14.2601 17.2104 13.8809 17.3818L14.293 18.293ZM11 2H3V4H11V2ZM20 11C20 6.02944 15.9706 2 11 2V4C14.866 4 18 7.13401 18 11H20ZM19.2041 14.7051C19.7157 13.5738 20 12.3188 20 11H18C18 12.029 17.7786 13.0036 17.3818 13.8809L19.2041 14.7051ZM17.5859 15.0001L20.2929 17.7071L21.7071 16.2929L19.0001 13.5859L17.5859 15.0001ZM20.2929 16.2929L16.2929 20.2929L17.7071 21.7071L21.7071 17.7071L20.2929 16.2929ZM17.7071 20.2929L15.0001 17.5859L13.5859 19.0001L16.2929 21.7071L17.7071 20.2929ZM11 20C12.3188 20 13.5738 19.7157 14.7051 19.2041L13.8809 17.3818C13.0036 17.7786 12.029 18 11 18V20ZM2 11C2 15.9706 6.02944 20 11 20V18C7.13401 18 4 14.866 4 11H2ZM2 3V11H4V3H2Z"
                                            fill="white"></path>
                                        <ellipse cx="11" cy="11" rx="2" ry="2"
                                            transform="rotate(-180 11 11)" fill="white"></ellipse>
                                        <path d="M3 3L11 11" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-medium text-white leading-tight">
                                        <span class="block">Framework</span>
                                        <span>support</span>
                                    </h4>
                                </div>
                            </div>
                            <p class="text-xl text-newGray-400">CodexAtlas is trained on the most popular languages and
                                frameworks. If we still don't support yours, feel free to get in touch.</p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4">
                        <div
                            class="max-w-md mx-auto h-full p-8 rounded-3xl shadow-box-green overflow-hidden bg-white bg-opacity-10">
                            <div class="flex mb-12 items-center">
                                <div
                                    class="flex-shrink-0 flex mr-4 items-center justify-center w-16 h-16 rounded-full bg-sky-500">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M6 9C6 5.68629 8.68629 3 12 3V3C15.3137 3 18 5.68629 18 9V15C18 18.3137 15.3137 21 12 21V21C8.68629 21 6 18.3137 6 15V9Z"
                                            stroke="white" stroke-width="2" stroke-linejoin="round"></path>
                                        <path d="M12 7L12 11" stroke="white" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-2xl font-medium text-white leading-tight">
                                        <span class="block">Constant</span>
                                        <span>monitoring</span>
                                    </h4>
                                </div>
                            </div>
                            <p class="text-xl text-newGray-400">CodexAtlas is connected to your repository provider,
                                and
                                it will monitor changes in your code to automatically keep the documentation updated.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 lg:py-32 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 right-0 w-186 h-186 bg-gradient-to-t from-violet-900 to-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div class="relative max-w-md md:max-w-8xl mx-auto">
                <div class="text-center mb-14">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        How does it work?</h2>
                    <p class="text-xl text-newGray-400">Setting up a new repository is a straight-forward process.</p>
                </div>
                <div class="flex flex-wrap items-center -mx-4 mb-16">
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <div
                            class="relative flex max-w-md pt-12 lg:pt-20 pl-12 lg:pl-20 items-end justify-end rounded-3xl overflow-hidden">
                            <img class="absolute top-0 left-0 w-full h-full"
                                src="{{ asset('casper-assets/how-it-works/bg-square-gradient.png') }}" alt="">
                            <img class="relative w-87 h-87 rounded-tl-3xl object-cover"
                                src="{{ asset('casper-assets/how-it-works/image-square-sm-1.png') }}" alt="">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <div class="max-w-lg">
                            <h3 class="font-heading text-4xl lg:text-5xl font-semibold text-white">01. Create a project
                            </h3>
                            <div class="my-6 h-1 w-full bg-white bg-opacity-20"></div>
                            <p class="text-xl text-white tracking-tight">Projects are the core of our lives as
                                developers. First of all, create a project using our platform.</p>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center -mx-4 mb-16">
                    <div class="w-full md:w-1/2 px-4 order-last md:order-first">
                        <div class="max-w-lg">
                            <h3 class="font-heading text-4xl lg:text-5xl font-semibold text-white">02. Add repositories
                            </h3>
                            <div class="my-6 h-1 w-full bg-white bg-opacity-20"></div>
                            <p class="text-xl text-white tracking-tight">Connect your GitHub account and choose which
                                repositories you want to add to the project. We will automatically configure the most
                                important branches for you.</p>
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <div
                            class="relative flex max-w-md pt-12 lg:pt-20 pl-12 lg:pl-20 md:ml-auto items-end justify-end rounded-3xl overflow-hidden">
                            <img class="absolute top-0 left-0 w-full h-full"
                                src="{{ asset('casper-assets/how-it-works/bg-square-gradient.png') }}"
                                alt="">
                            <img class="relative w-87 h-87 rounded-tl-3xl object-cover"
                                src="{{ asset('casper-assets/how-it-works/image-square-sm-2.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap items-center -mx-4">
                    <div class="w-full md:w-1/2 px-4 mb-8 md:mb-0">
                        <div
                            class="relative flex max-w-md pt-12 lg:pt-20 pl-12 lg:pl-20 items-end justify-end rounded-3xl overflow-hidden">
                            <img class="absolute top-0 left-0 w-full h-full"
                                src="{{ asset('casper-assets/how-it-works/bg-square-gradient.png') }}"
                                alt="">
                            <img class="relative w-87 h-87 rounded-tl-3xl object-cover"
                                src="{{ asset('casper-assets/how-it-works/image-square-sm-3.png') }}" alt="">
                        </div>
                    </div>
                    <div class="w-full md:w-1/2 px-4">
                        <div class="max-w-lg">
                            <h3 class="font-heading text-4xl lg:text-5xl font-semibold text-white">03. Enjoy your docs
                            </h3>
                            <div class="my-6 h-1 w-full bg-white bg-opacity-20"></div>
                            <p class="text-xl text-white tracking-tight">Once the repository is added, our system will
                                start to document your code and will take care of keeping it up-to-date in your own
                                subdomain.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 right-0 -mr-52 -mt-64 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div class="relative mx-auto lg:mx-0 mb-32">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl lg:text-7xl font-medium text-white tracking-tight mb-6">
                    Best-in-class documentation
                </h2>
                <p class="max-w-4xl text-xl text-newGray-500 tracking-tight">We are constantly improving CodexAtlas and
                    keeping it up-to-date with the latest versions of each framework and language. But we are also doing
                    some other cool stuff that will be available soon.</p>
            </div>
            <div class="relative max-w-md lg:max-w-none mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="w-full">
                        <div
                            class="group block h-auto xl:h-[20rem] p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        On-premise enterprise plan</h3>
                                    <p class="text-violet-100 tracking-tight leading-5">We understand that for some
                                        organizations, code is something really private. Reach out to us for an
                                        on-premise version so that your code will never leave your servers.
                                        <strong>One-time payment. Pay once, use forever.</strong>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-auto xl:h-[20rem] p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <span
                                    class="bg-violet-500 ml-auto px-4 py-2 text-sm text-white font-medium rounded-full">
                                    Coming soon
                                </span>
                                <div class="mt-auto max-w-xs">
                                    <h2
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Self-host your docs</h2>
                                    <p class="text-violet-100 tracking-tight leading-5">We are working on connecting
                                        to
                                        Confluence, GitHub Wikis and Notion, apart from letting you download your
                                        documentation in Markdown format.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-auto xl:h-[20rem] p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <span
                                    class="bg-violet-500 ml-auto px-4 py-2 text-sm text-white font-medium rounded-full">
                                    Coming soon
                                </span>
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Intelligent copilot
                                    </h3>
                                    <p class="text-violet-100 tracking-tight leading-5">We want to reduce the time
                                        between introducing a new person to a project and developing their first
                                        feature. Having all the knowledge of your code will help us do it.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-auto xl:h-[20rem] p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <span
                                    class="bg-violet-500 ml-auto px-4 py-2 text-sm text-white font-medium rounded-full">
                                    Coming soon
                                </span>
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Pull Request Assistant
                                    </h3>
                                    <p class="text-violet-100 tracking-tight leading-5">
                                        An intelligent assistant directly in GitHub, Gitlab and Bitbucket. Every time
                                        you review a PR, you can write <code
                                            class="bg-black p-1 rounded text-violet-50">/codex
                                            {instruction}</code> and Codex will
                                        do the change for you, making revisions of Pull Requests up to 2 times faster.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-auto xl:h-[20rem] p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <span
                                    class="bg-violet-500 ml-auto px-4 py-2 text-sm text-white font-medium rounded-full">
                                    Coming soon
                                </span>
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Glossary
                                    </h3>
                                    <p class="text-violet-100 tracking-tight leading-5">
                                        Help the LLM understand better your code with glossary, by adding custom words
                                        and their meaning to your knowledge database. Codex will use them to generate
                                        better documentation.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-auto xl:h-[20rem] p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <span
                                    class="bg-violet-500 ml-auto px-4 py-2 text-sm text-white font-medium rounded-full">
                                    Coming soon
                                </span>
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Video documentation
                                    </h3>
                                    <p class="text-violet-100 tracking-tight leading-5">
                                        Codex will detect the business use cases from your code, and generate
                                        <strong>video and audio</strong> documentation explaining how every feature
                                        works.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @if (Route::has('register'))
                    <div class="text-center mt-12">
                        <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                            href="{{ route('register') }}">
                            <span class="mr-2">{{ __('Try it for free') }}</span>
                            <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                    fill="currentColor"></path>
                            </svg>
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 lg:py-32 bg-body overflow-hidden">
        <div
            class="absolute top-0 left-0 -mt-128 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
        </div>
        <img class="absolute top-0 right-0 mt-16" src="{{ asset('casper-assets/portfolio/double-lines.svg') }}"
            alt="">
        <div class="relative container mx-auto px-4">
            <div class="relative max-w-2xl mx-auto mb-12 text-center">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                    Check our demos</h2>
                <p class="max-w-xl mx-auto text-xl text-newGray-500 leading-relaxed tracking-tight">Feel
                    free to check our demos at how your project could look like in CodexAtlas.</p>
            </div>
        </div>
        <div class="relative mb-16 overflow-hidden">
            <div class="grid gap-8 sm:gap-0 sm:flex justify-center items-center px-4 lg:px-0 mb-8">
                <x-homepage.demo-project class="sm:-ml-20" :project="\App\Demo\DemoList::get()->demo(0)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(1)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(2)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(3)" />
            </div>
            <div class="grid gap-9 sm:gap-0 sm:flex justify-center items-center px-4 sm:px-0">
                <x-homepage.demo-project class="sm:-ml-64" :project="\App\Demo\DemoList::get()->demo(4)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(5)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(6)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(7)" />
            </div>
        </div>
    </section>

    @if (paymentIsWithAws())
        <section class="relative py-12 md:pb-24 lg:pb-32 bg-body overflow-hidden" id="pricing">
            <div class="relative container mx-auto px-4 z-10">
                <div
                    class="absolute top-0 left-0 -mt-40 -ml-52 w-186 z-10 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
                </div>
                <div class="relative z-10 max-w-2xl mx-auto mb-14 text-center">
                    <span
                        class="inline-flex items-center px-3.5 h-7 mb-4 text-xs font-medium text-white leading-6 bg-gradient-tag rounded-full">PRICING
                        PLAN</span>
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl xl:text-7xl font-medium text-white tracking-tight mb-4">
                        Choose your plan</h2>
                    <p class="max-w-lg mx-auto text-lg leading-snug tracking-tight text-newGray-500">
                        From pet projects to enterprise-grade systems, we've got it!
                    </p>
                </div>
                <div class="relative z-10 max-w-md lg:max-w-8xl mx-auto">
                    <div class="flex flex-wrap -mx-4">
                        <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-1.png')" price="Free" title="Free Trial"
                            description="Try out CodexAtlas without any
                compromise and without your credit card. For free."
                            :included="[
                                'Real-time documentation updates',
                                'Up to 1 repository',
                                'Up to 1 branch per repository',
                                'Up to ' .
                                \App\Enums\SubscriptionType::FreeTrial->maxFilesPerRepository() .
                                ' files per branch',
                            ]" :notIncluded="[
                                'Integration with external platforms (Confluence, Notion...)',
                                'Pull Request Assistant',
                                'AI Chatbot',
                                'Premium support',
                            ]" cta="Start for free" :ctaUrl="Route::has('register') ? route('register') : '#'" />
                        <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-2.png')" price="Pay as you go" title="AWS Subscription"
                            description="Subscribe to Codex on the AWS Marketplace and start documenting your code at scale."
                            :included="[
                                'Real-time documentation updates',
                                'Unlimited repositories',
                                'Unlimited branches',
                                'Unlimited files per branch',
                                'Integration with external platforms (Confluence, Notion...) - soon',
                                'Pull Request Assistant - soon',
                                'AI Chatbot - soon',
                                'Premium support',
                            ]" :notIncluded="[]" cta="Subscribe" :ctaUrl="config('codex.aws_marketplace_link')" />
                        <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-3.png')" price="Enterprise" title="One yearly payment"
                            description="Use your own server for offline processing of code powered by open source models."
                            :included="[
                                'Real-time documentation updates',
                                'Unlimited usage',
                                'Custom integrations',
                                'Free security and minor updates',
                                '100% private. Runs on your own server with best-in-class models',
                                'SLA agreement',
                                'Powered by open source',
                                'Maintenance included the first year',
                            ]" :notIncluded="[]" cta="Get in touch" :ctaUrl="'mailto:' . config('codex.support_email')" />
                    </div>
                </div>
            </div>
        </section>
    @else
        <section class="relative py-12 md:pb-24 lg:pb-32 bg-body overflow-hidden" id="pricing">
            <div class="relative container mx-auto px-4 z-10">
                <div
                    class="absolute top-0 left-0 -mt-40 -ml-52 w-186 z-10 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
                </div>
                <div class="relative z-10 max-w-2xl mx-auto mb-14 text-center">
                    <span
                        class="inline-flex items-center px-3.5 h-7 mb-4 text-xs font-medium text-white leading-6 bg-gradient-tag rounded-full">PRICING
                        PLAN</span>
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl xl:text-7xl font-medium text-white tracking-tight mb-4">
                        Choose Your Plan</h2>
                    <p class="max-w-md mx-auto text-lg leading-snug tracking-tight text-newGray-500">
                        From pet projects to enterprise-grade systems, we've got it!
                    </p>
                </div>
                <div class="relative z-10 max-w-md lg:max-w-8xl mx-auto">
                    <div class="flex flex-wrap -mx-4">
                        <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-1.png')" price="Free" title="Free Trial"
                            description="Try out CodexAtlas without any
                    compromise and without your credit card. For free."
                            :included="[
                                'Real-time documentation updates',
                                'Up to 1 repository',
                                'Up to 1 branch per repository',
                                'Up to ' .
                                \App\Enums\SubscriptionType::FreeTrial->maxFilesPerRepository() .
                                ' files per branch',
                            ]" :notIncluded="[
                                'Integration with external platforms (Confluence, Notion...)',
                                'Pull Request Assistant',
                                'AI Chatbot',
                                'Premium support',
                            ]" cta="Start for free" :ctaUrl="Route::has('register') ? route('register') : '#'" />
                        @if (config('codex.pay_as_you_go'))
                            <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-2.png')" price="Pay as you go"
                                title="Your own OpenAI Key" description="Use CodexAtlas with your own OpenAI API Key."
                                :included="[
                                    'Real-time documentation updates',
                                    'Unlimited repositories',
                                    'Unlimited branches',
                                    'Unlimited files per branch',
                                ]" :notIncluded="[
                                    'Integration with external platforms (Confluence, Notion...)',
                                    'Pull Request Assistant',
                                    'AI Chatbot',
                                    'Premium support',
                                ]" cta="Start for free" :ctaUrl="Route::has('register') ? route('register') : '#'" />
                        @endif
                        @php
                            $monthlyPlan = \App\Cashier\StripePlanProvider::plans()->firstWhere(
                                'id',
                                config('spark.billables.user.plans.0.monthly_id'),
                            );
                        @endphp
                        <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-3.png')" price="Company" :title="$monthlyPlan?->price . ' / month'"
                            description="Best for middle sized companies that want to integrate CodexAtlas with their workflow."
                            :included="[
                                'Real-time documentation updates',
                                'Unlimited repositories',
                                'Unlimited branches',
                                'Unlimited files per branch',
                                'Integration with Confluence and Notion (soon)',
                                'Pull Request Assistant (soon)',
                                'AI Chatbot (soon)',
                                'Premium support',
                            ]" :notIncluded="[]" cta="Subscribe" :ctaUrl="route('spark.portal')" />
                    </div>
                    <div class="relative mx-auto mb-8 p-10 rounded-3xl overflow-hidden mt-12 lg:mt-24">
                        <div
                            class="absolute top-0 left-0 w-full h-full backdrop-filter backdrop-blur-md bg-newGray-500 bg-opacity-20 group-hover:bg-violet-400 group-hover:bg-opacity-100 transition duration-150">
                        </div>
                        <div class="relative flex flex-wrap md:flex-nowrap -mx-4 items-center">
                            <div class="w-full md:w-auto px-4 mb-8 md:mb-0">
                                <div class="sm:flex items-center">
                                    <img src="{{ asset('casper-assets/pricing/robot.png') }}" alt="">
                                    <div class=" mt-3 sm:mt-0 sm:ml-8">
                                        <h3 class="text-3xl font-medium text-white">Enterprise</h3>
                                        <p class="text-sm text-newGray-300 max-w-lg mt-2">Not sure if we can work
                                            together?
                                            We
                                            can
                                            help you
                                            integrate CodexAtlas in your company and increase the productivity of your
                                            developers.</p>
                                        <ul class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-4">
                                            <x-homepage.pricing-included text="On-premise system" />
                                            <x-homepage.pricing-included text="Custom integrations" />
                                            <x-homepage.pricing-included text="Custom SLA" />
                                            <x-homepage.pricing-included text="Dedicated support team" />
                                            <x-homepage.pricing-included class="md:col-span-2"
                                                text="Custom, on-premise AI model (no data shared with OpenAI)" />
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full md:w-auto ml-auto flex-shrink-0 px-4">
                                <div>
                                    <a class="group inline-flex w-auto h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-violet-500 bg-violet-500 hover:bg-white transition duration-200 rounded-full"
                                        href="mailto:{{ config('codex.support_email') }}">
                                        <span class="mr-2">Get in touch</span>
                                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                                fill="currentColor"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <section class="relative py-12 md:py-24 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div class="relative flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/2 xl:w-2/5 px-4 pb-20 lg:pb-32">
                    <div class="relative z-10 max-w-md mx-auto lg:mx-0">
                        <div
                            class="absolute top-0 left-0 -mt-96 hidden -ml-40 w-170 h-170 bg-gradient-to-t from-purple-600 via-darkBlue-900 to-transparent rounded-full filter blur-4xl lg:block">
                        </div>
                        <div class="relative">
                            <h2
                                class="font-heading text-4xl xs:text-5xl sm:text-6xl font-medium text-white tracking-tight mb-8">
                                Any questions?</h2>
                        </div>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/2 xl:w-3/5 px-4">
                    <div
                        class="absolute bottom-0 right-0 w-186 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
                    </div>
                    <div class="relative max-w-lg lg:max-w-none mx-auto">
                        <div>
                            <x-homepage.faq-question question="Can I download the documentation?"
                                answer="Yes, you will be able to download the documentation in Markdown format to import it in any system you might use." />
                            <x-homepage.faq-question question="Can I use it for my open source project?"
                                answer="Absolutely. Just get in touch and we will set up a forever-free platform for your project." />
                            <x-homepage.faq-question
                                question="I want to use it, but I cannot share my code with OpenAI"
                                answer="If you can work with a custom Azure model in your own account, let us know. If not, Codex also works with open source models that can run on-premises, on your own servers, so your data is always yours. Feel free to get in touch with us!" />
                            <x-homepage.faq-question question="Is my code stored by CodexAtlas?"
                                answer="No. Your code is never stored in our servers. It's just read to create the documentation and then deleted. We do store a vector representation of the code to provide advanced AI capabilities." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
