<x-web-layout>
    <div class="relative pt-24 lg:pt-44 pb-40 lg:pb-72">
        <div class="relative z-10 container mx-auto px-4">
            <div class="flex flex-wrap -mx-4 items-center">
                <div class="max-w-md mx-auto lg:max-w-5xl text-center">
                    <h1
                        class="font-heading text-4xl sm:text-6xl md:text-7xl xl:text-8xl text-white font-semibold leading-none mb-8">
                        Instantly document your code</h1>
                    <p class="text-2xl text-gray-400 mb-8">
                        <span class="block">Connect CodexAtlas to your GitHub account</span>
                        <span class="block">and keep your documentation updated</span>
                    </p>
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
            </div>
        </div>
        <img class="absolute bottom-0 left-0 w-full" src="{{ asset('casper-assets/headers/bg-bottom-lines.png') }}"
            alt="">
    </div>

    <section class="relative py-12 md:py-24 bg-body overflow-hidden">
        <img class="absolute bottom-0 right-0" src="{{ asset('casper-assets/features/double-line-circle.svg') }}"
            alt="">
        <img class="hidden md:block z-10 absolute top-0 left-0 mt-24 ml-4 lg:ml-24 xl:ml-64 animate-spinStar"
            src="{{ asset('casper-assets/features/blink-star.png') }}" alt="">
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
                    <p class="text-xl text-gray-400">CodexAtlas reduces 99% of the manual work on documenting software
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
                            <p class="text-xl text-gray-400">Powered by state-of-the-art artificial intelligence,
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
                            <p class="text-xl text-gray-400">CodexAtlas is trained on the most popular languages and
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
                            <p class="text-xl text-gray-400">CodexAtlas is connected to your repository provider, and
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
                    <p class="text-xl text-gray-400">Setting up a new repository is a straight-forward process.</p>
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
                                src="{{ asset('casper-assets/how-it-works/bg-square-gradient.png') }}" alt="">
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
                                src="{{ asset('casper-assets/how-it-works/bg-square-gradient.png') }}" alt="">
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
            <img class="hidden md:block absolute top-0 right-0 animate-spinStar z-10"
                src="casper-assets/services/blink-star.png" alt="">
            <div
                class="absolute top-0 right-0 -mr-52 -mt-64 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div class="relative max-w-md lg:max-w-4xl mx-auto lg:mx-0 mb-32">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl lg:text-7xl font-medium text-white tracking-tight mb-6">
                    In the works</h2>
                <p class="max-w-xl text-xl text-gray-500 tracking-tight">We are constantly improving CodexAtlas and
                    keeping it up-to-date with the latest versions of each framework and language. But we are also doing
                    some other cool stuff that will be available soon.</p>
            </div>
            <div class="relative max-w-md lg:max-w-none mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                        <div
                            class="group block h-auto xl:h-128 p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <div class="mt-auto max-w-xs">
                                    <h2
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Self-host your docs</h2>
                                    <p class="text-gray-500 tracking-tight leading-5">We are working on connecting to
                                        Confluence, GitHub Wikis and Notion, apart from letting you download your
                                        documentation in Markdown format.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                        <div
                            class="group block h-auto xl:h-128 p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        On-premise enterprise plan</h3>
                                    <p class="text-gray-500 tracking-tight leading-5">We understand that for some
                                        organizations, code is something really private. We are working on an on-premise
                                        version so that your code will never leave your servers.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4">
                        <div
                            class="group block h-auto xl:h-128 p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <div class="mt-auto max-w-xs">
                                    <h3
                                        class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                        Intelligent feature copilot</h3>
                                    <p class="text-gray-500 tracking-tight leading-5">We want to reduce the time
                                        between introducing a new person to a project and developing their first
                                        feature. Having all the knowledge of your code will help us do it.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 lg:py-32 bg-body overflow-hidden">
        <div
            class="absolute top-0 left-0 -mt-128 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
        </div>
        <img class="absolute top-0 right-0 mt-16" src="{{ asset('casper-assets/portfolio/double-lines.svg') }}"
            alt="">
        <img class="hidden md:block absolute top-0 right-0 mt-8 mr-20 lg:mr-40 animate-spinStar z-10"
            src="{{ asset('casper-assets/services/blink-star.png') }}" alt="">
        <div class="relative container mx-auto px-4">
            <div class="relative max-w-2xl mx-auto mb-12 text-center">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                    Check our demos</h2>
                <p class="max-w-xl mx-auto text-xl text-gray-500 leading-relaxed tracking-tight">Feel
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

    {{--
    <section class="relative py-12 md:py-24 lg:py-32 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 left-0 -mt-80 -ml-32 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
            </div>
            <div
                class="absolute bottom-0 right-0 -mb-20 -mr-52 w-186 h-186 bg-gradient-to-t from-blue-500 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
            </div>
            <img class="hidden lg:block absolute bottom-0 right-0 -mr-32 xl:-mr-10 animate-movePlant"
                src="casper-assets/pricing/robot-fly.png" alt="">
            <div class="relative max-w-2xl mx-auto mb-14 text-center">
                <img class="hidden md:block absolute bottom-0 left-0 -ml-40 lg:-ml-80 xl:-ml-112 lg:-mb-24 w-52 lg:w-auto animate-movePlanet"
                    src="casper-assets/pricing/planet.png" alt="">
                <span
                    class="inline-flex items-center px-3.5 h-7 mb-4 text-xs font-medium text-white leading-6 bg-gradient-tag rounded-full">PRICING
                    PLAN</span>
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl xl:text-7xl font-medium text-white tracking-tight mb-4">
                    Choose Your Plan</h2>
                <div class="flex items-center justify-center">
                    <span class="text-xl tracking-tight text-white">Billed Monthly</span>
                    <div class="inline-flex items-center mx-4 h-6 p-0.5 bg-violet-400 rounded-full">
                        <button class="inline-block w-5 h-5 rounded-full bg-transparent"></button>
                        <button class="inline-block w-5 h-5 rounded-full bg-violet-800"></button>
                    </div>
                    <span class="text-xl tracking-tight text-white">Billed Yearly</span>
                </div>
            </div>
            <div class="relative max-w-xs sm:max-w-md md:max-w-3xl mx-auto mb-8 p-10 rounded-3xl overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full h-full backdrop-filter backdrop-blur-md bg-gray-500 bg-opacity-20 group-hover:bg-violet-400 group-hover:bg-opacity-100 transition duration-150">
                </div>
                <div class="relative flex flex-wrap md:flex-nowrap -mx-4 items-center">
                    <div class="w-full md:w-auto px-4 mb-8 md:mb-0">
                        <div class="sm:flex items-center">
                            <img src="casper-assets/pricing/robot-sm.png" alt="">
                            <div class="max-w-xs mt-3 sm:mt-0 sm:ml-8">
                                <h3 class="text-3xl font-medium text-white">Basic</h3>
                                <p class="text-sm text-gray-300">Simply dummy text of the printing and typesetting
                                    industry.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-auto ml-auto flex-shrink-0 px-4">
                        <div>
                            <span class="block mb-3 text-4xl font-medium text-white">$25</span>
                            <a class="group inline-flex w-auto h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-violet-500 bg-violet-500 hover:bg-white transition duration-200 rounded-full"
                                href="#">
                                <span class="mr-2">CHOOSE PLAN</span>
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
            <div class="relative max-w-xs sm:max-w-md md:max-w-3xl mx-auto mb-8 p-10 rounded-3xl overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full h-full backdrop-filter backdrop-blur-md bg-gray-500 bg-opacity-20 group-hover:bg-violet-400 group-hover:bg-opacity-100 transition duration-150">
                </div>
                <div class="relative flex flex-wrap md:flex-nowrap -mx-4 items-center">
                    <div class="w-full md:w-auto px-4 mb-8 md:mb-0">
                        <div class="sm:flex items-center">
                            <img src="casper-assets/pricing/robot.png" alt="">
                            <div class="max-w-xs mt-3 sm:mt-0 sm:ml-8">
                                <h3 class="text-3xl font-medium text-white">Advanced</h3>
                                <p class="text-sm text-gray-300">Simply dummy text of the printing and typesetting
                                    industry.</p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full md:w-auto ml-auto flex-shrink-0 px-4">
                        <div>
                            <span class="block mb-3 text-4xl font-medium text-white">$50</span>
                            <a class="group inline-flex w-auto h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-violet-500 bg-violet-500 hover:bg-white transition duration-200 rounded-full"
                                href="#">
                                <span class="mr-2">CHOOSE PLAN</span>
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
    </section> --}}

    <section class="relative py-12 md:py-20 bg-body overflow-hidden">
        <div class="container mx-auto px-4">
            <div class="max-w-lg lg:max-w-8xl mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full lg:w-3/5 px-4 mb-8 lg:mb-0">
                        <div
                            class="h-full py-16 px-14 bg-gradient-to-br from-blueGray-700 via-blueGray-900 to-sky-900 rounded-3xl">
                            <div class="relative max-w-md mx-auto lg:mx-0">
                                <h2
                                    class="max-w-sm font-heading text-4xl xs:text-5xl sm:text-6xl font-medium text-white tracking-tight mb-4">
                                    Free for limited time</h2>
                                <p class="text-lg text-blue-100 tracking-tight mb-34">CodexAtlas will be offered for
                                    free during the alpha phase. Sign up and stay free!</p>
                                {{-- <div class="flex mb-6 items-center">
                                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M7.50002 6.00002C7.20334 6.00002 6.91333 6.08799 6.66666 6.25281C6.41999 6.41763 6.22773 6.6519 6.1142 6.92599C6.00067 7.20008 5.97096 7.50168 6.02884 7.79265C6.08672 8.08362 6.22958 8.3509 6.43936 8.56068C6.64914 8.77046 6.91641 8.91332 7.20738 8.97119C7.49835 9.02907 7.79995 8.99937 8.07404 8.88584C8.34813 8.7723 8.5824 8.58005 8.74722 8.33337C8.91204 8.0867 9.00002 7.79669 9.00002 7.50002C9.00002 7.10219 8.84198 6.72066 8.56068 6.43936C8.27937 6.15805 7.89784 6.00002 7.50002 6.00002ZM21.12 10.71L12.71 2.29002C12.6166 2.19734 12.5058 2.12401 12.3839 2.07425C12.2621 2.02448 12.1316 1.99926 12 2.00002H3.00002C2.7348 2.00002 2.48045 2.10537 2.29291 2.29291C2.10537 2.48045 2.00002 2.7348 2.00002 3.00002V12C1.99926 12.1316 2.02448 12.2621 2.07425 12.3839C2.12401 12.5058 2.19734 12.6166 2.29002 12.71L10.71 21.12C11.2725 21.6818 12.035 21.9974 12.83 21.9974C13.625 21.9974 14.3875 21.6818 14.95 21.12L21.12 15C21.6818 14.4375 21.9974 13.675 21.9974 12.88C21.9974 12.085 21.6818 11.3225 21.12 10.76V10.71ZM19.71 13.53L13.53 19.7C13.3427 19.8863 13.0892 19.9908 12.825 19.9908C12.5608 19.9908 12.3074 19.8863 12.12 19.7L4.00002 11.59V4.00002H11.59L19.71 12.12C19.8027 12.2135 19.876 12.3243 19.9258 12.4461C19.9756 12.5679 20.0008 12.6984 20 12.83C19.9989 13.0924 19.8948 13.3438 19.71 13.53Z"
                                            fill="#FFB11A"></path>
                                    </svg>
                                    <span class="ml-3 text-3xl font-medium text-white">Only $50</span>
                                </div> --}}
                                <a class="group mt-8 inline-flex w-full md:w-auto h-14 px-7 items-center justify-center text-base font-medium text-violet-900 hover:text-white bg-white hover:bg-violet-600 transition duration-200 rounded-full"
                                    href="{{ route('register') }}">
                                    <span class="mr-2">{{ __('Start for free') }}</span>
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
                    <div class="w-full lg:w-2/5 px-4">
                        <div
                            class="w-full h-full rounded-3xl bg-gradient-to-tr from-[#070C2A] to-violet-900 flex items-center justify-center py-8">
                            <x-application-logo class="w-32 h-32" :name="true" :vertical="true"
                                nameClass="text-3xl text-white font-bold" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div class="relative flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/2 xl:w-2/5 px-4 pb-20 lg:pb-32">
                    <div class="relative z-10 max-w-md mx-auto lg:mx-0">
                        <div
                            class="absolute top-0 left-0 -mt-96 -ml-40 w-170 h-170 bg-gradient-to-t from-purple-600 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
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
                            <x-homepage.faq-question question="Is it really free?"
                                answer="For now, it is! We are still working out the pricing, but will be free while we are in the alpha phase." />
                            <x-homepage.faq-question question="Can I download the documentation?"
                                answer="Yes, you will be able to download the documentation in Markdown format to import it in any system you might use." />
                            <x-homepage.faq-question question="Can I use it for my open source project?"
                                answer="Absolutely. Just get in touch and we will set up a forever-free platform for your project." />
                            <x-homepage.faq-question
                                question="I want to use it, but I cannot share my code with OpenAI"
                                answer="If you can work with a custom Azure model in your own account, let us know. If not, we want to let you know that we are working on custom models that could be deployed in your own servers. Feel free to get in touch with us!" />
                            <x-homepage.faq-question question="Is my code safe?"
                                answer="Your code is stored using different encryption methods to ensure its safety. Also, it will not be shared with anyone apart from the LLM provider we work with." />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
