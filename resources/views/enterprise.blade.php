<x-web-layout>
    @section('title', 'Privacy-first code documentation for your company | CodexAtlas')
    @section('og_title', 'Privacy-first code documentation for your company')
    @section('og_image', asset('images/enterprise-og.png'))
    <section class="relative pb-8 bg-body overflow-hidden">
        <img class="absolute top-0 right-0" src="{{ asset('casper-assets/headers/circle-double-element-dark.svg') }}"
            alt="">
        <div class="relative py-10">
            <div class="container mx-auto px-4">
                <div class="text-center">
                    <h1 class="font-heading text-6xl md:text-8xl xl:text-9xl font-semibold text-white tracking-tight">
                        <span>Codex</span>
                        <span
                            class="-ml-4 bg-clip-text text-transparent bg-gradient-to-br from-violet-900 via-blueGray-900 to-sky-900">B2B</span>
                    </h1>
                </div>
            </div>
        </div>
        <div class="relative container mx-auto px-4">
            <div class="flex flex-wrap -mx-4">
                <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                    <a class="group block max-w-md mx-auto lg:max-w-none bg-radial to-indigo-900 from-blueGray-800 rounded-3xl overflow-hidden"
                        href="#perpetual-license">
                        <div
                            class="relative h-148 bg-opacity-0 bg-blueGray-800 group-hover:bg-opacity-100 transition duration-500">
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                <img class="h-96 transform group-hover:scale-105 transition duration-300 object-contain"
                                    src="{{ asset('casper-assets/headers/plant-robo.png') }}" alt="">
                            </div>
                            <div class="relative flex flex-col p-10 h-full">
                                <span class="block text-5xl text-white font-medium">01</span>
                                <span class="block mt-auto text-4xl text-white">Perpetual</span>
                                <span class="block text-4xl text-white">License</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                    <a class="group block max-w-md mx-auto lg:max-w-none bg-radial to-orange-800 from-orange-600 rounded-3xl overflow-hidden"
                        href="#your-own-hardware">
                        <div
                            class="relative h-148 bg-opacity-0 bg-orange-600 group-hover:bg-opacity-100 transition duration-500">
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                <img class="h-96 transform group-hover:scale-105 transition duration-300 object-contain"
                                    src="{{ asset('casper-assets/headers/box-items.png') }}" alt="">
                            </div>
                            <div class="relative flex flex-col p-10 h-full">
                                <span class="block text-5xl text-white font-medium">02</span>
                                <span class="block mt-auto text-4xl text-white">Your own</span>
                                <span class="block text-4xl text-white">Hardware</span>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="w-full lg:w-1/3 px-4">
                    <a class="group block max-w-md mx-auto lg:max-w-none bg-radial to-teal-800 from-teal-600 rounded-3xl overflow-hidden"
                        href="#best-in-class-documentation">
                        <div
                            class="relative h-148 bg-opacity-0 bg-teal-600 group-hover:bg-opacity-100 transition duration-500">
                            <div class="absolute top-0 left-0 w-full h-full flex items-center justify-center">
                                <img class="h-96 px-4 transform group-hover:scale-105 transition duration-300 object-contain"
                                    src="{{ asset('casper-assets/headers/robot-knight.png') }}" alt="">
                            </div>
                            <div class="relative flex flex-col p-10 h-full">
                                <span class="block text-5xl text-white font-medium">03</span>
                                <span class="block mt-auto text-4xl text-white">Best-in-class</span>
                                <span class="block text-4xl text-white">documentation</span>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 lg:py-32 bg-body overflow-hidden" id="perpetual-license">
        <img class="absolute top-0 right-0 -mr-64 lg:-mr-0"
            src="{{ asset('casper-assets/about/doublie-line-top-right.svg') }}" alt="">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 right-0 -mt-80 mr-40 w-186 h-186 bg-gradient-to-t from-violet-900 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
            </div>
            <div class="relative grid gap-12 lg:grid-cols-2">
                <div class="max-w-md">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-4">
                        Your code is yours.<br>Codex too.
                    </h2>
                    <a class="inline-flex items-center text-sm font-medium text-violet-500 hover:text-white uppercase"
                        href="#cta">
                        <span class="mr-2">GET TO KNOW US</span>
                        <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M17.92 6.62C17.8185 6.37565 17.6243 6.18147 17.38 6.08C17.2598 6.02876 17.1307 6.00158 17 6H7C6.73478 6 6.48043 6.10536 6.29289 6.29289C6.10536 6.48043 6 6.73478 6 7C6 7.26522 6.10536 7.51957 6.29289 7.70711C6.48043 7.89464 6.73478 8 7 8H14.59L6.29 16.29C6.19627 16.383 6.12188 16.4936 6.07111 16.6154C6.02034 16.7373 5.9942 16.868 5.9942 17C5.9942 17.132 6.02034 17.2627 6.07111 17.3846C6.12188 17.5064 6.19627 17.617 6.29 17.71C6.38296 17.8037 6.49356 17.8781 6.61542 17.9289C6.73728 17.9797 6.86799 18.0058 7 18.0058C7.13201 18.0058 7.26272 17.9797 7.38458 17.9289C7.50644 17.8781 7.61704 17.8037 7.71 17.71L16 9.41V17C16 17.2652 16.1054 17.5196 16.2929 17.7071C16.4804 17.8946 16.7348 18 17 18C17.2652 18 17.5196 17.8946 17.7071 17.7071C17.8946 17.5196 18 17.2652 18 17V7C17.9984 6.86932 17.9712 6.74022 17.92 6.62Z"
                                fill="currentColor"></path>
                        </svg>
                    </a>
                </div>
                <div class="max-w-3xl ml-auto prose prose-invert prose-lg">
                    <p>
                        Today, most software is a service. Not owned, but rented. Buying it enters you into a perpetual
                        landlord-tenant agreement. Every month you pay for essentially the same thing you had last
                        month. And if you stop paying, the software stops working.
                    </p>
                    <p>
                        At Codex, we believe that business software should be owned, not rented. That's why we offer a
                        perpetual
                        license for all of our products. Once you buy it, it's yours. Forever.
                    </p>
                    <p>
                        By purchasing a <strong>CodexB2B</strong> license, you get:
                    </p>
                    <ul>
                        <li>Your own physical server running Codex</li>
                        <li>Free updates</li>
                        <li>On-premise code documentation: Your code will never be sent outside of your own network</li>
                        <li>Maximum privacy with open source LLMs</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 sm:py-24 bg-body overflow-hidden" id="your-own-hardware" x-data="{ slide: 0 }"
        x-init="setInterval(() => slide = (slide + 1) % 4, 10000)">
        <div class="relative container mx-auto px-4">
            <div class="flex flex-wrap items-center -mx-4 mb-20">
                <div class="relative w-full lg:w-1/2 px-4 order-last lg:order-first">
                    <div
                        class="absolute top-0 right-0 -mt-10 -mr-20 w-135 h-135 bg-gradient-to-t from-violet-900 to-darkBlue-900 rounded-full filter blur-4xl">
                    </div>
                    <div class="relative max-w-md xl:max-w-xl mx-auto lg:mx-0 pr-6">
                        <img class="relative z-10 block w-full"
                            src="{{ asset('casper-assets/features/image-left-chip.png') }}" alt="">
                        <img class="absolute top-1/2 right-0 transform -translate-y-1/2 w-7 h-full py-6"
                            src="{{ asset('casper-assets/features/shadow-first.png') }}" alt="">
                        <img class="absolute top-1/2 right-0 transform -translate-y-1/2 -mr-6 h-full py-14 w-6"
                            src="{{ asset('casper-assets/features/shadow-second.png') }}" alt="">
                    </div>
                </div>
                <div class="relative w-full lg:w-1/2 px-4 mb-20 lg:mb-0" x-show="slide === 0" x-cloak>
                    <div class="max-w-sm xs:max-w-xl">
                        <h2
                            class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-8">
                            What will you get?
                        </h2>
                        <p class="text-xl text-gray-400 mb-4">
                            By purchasing a <strong>CodexB2B</strong> license, you will get a <strong>Mac mini server
                                running
                                Codex</strong>.
                            You will just need to plug it in, connect it to your network and follow the
                            configuration
                            steps. We will be there to support you every step of the way.
                        </p>
                        <p class="text-xl text-gray-400 mb-8">
                            This computer will be yours to keep. You will be able to use it for other purposes as
                            well,
                            but we recommend keeping it dedicated to Codex for maximum performance.
                        </p>
                        <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-violet-500 bg-transparent hover:bg-white border-2 border-white transition duration-200 rounded-full"
                            href="#cta">
                            <span class="mr-2">GET IN TOUCH</span>
                            <span class="animate-spinSlow group-hover:animate-none">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.9999 11C11.8021 11 11.6088 11.0586 11.4443 11.1685C11.2799 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.153 12.5673 11.2928 12.7071C11.4327 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1999 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8314 12.5556C12.9413 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8946 11.4804 12.707 11.2929C12.5195 11.1054 12.2651 11 11.9999 11ZM19.6199 12L19.7299 11.86C21.0799 10 21.3999 8.29 20.6599 7C19.9199 5.71 18.2599 5.14 15.9999 5.37H15.8199C14.9099 3.3 13.5599 2 11.9999 2C10.4399 2 9.08991 3.3 8.18991 5.4L7.99991 5.37C5.73991 5.14 4.07991 5.71 3.33991 7C2.59991 8.29 2.91991 10 4.26991 11.86L4.37991 12L4.26991 12.14C2.91991 14 2.59991 15.71 3.33991 17C3.99991 18.1 5.26991 18.68 6.99991 18.68C7.30991 18.68 7.62991 18.68 7.99991 18.63H8.17991C9.08991 20.7 10.4399 22 11.9999 22C13.5599 22 14.9099 20.7 15.8099 18.6H15.9899C16.3299 18.6 16.6499 18.65 16.9899 18.65C18.7599 18.65 20.0599 18.07 20.6899 16.97C21.4299 15.68 21.1099 13.97 19.7599 12.11L19.6199 12ZM5.06991 8C5.31991 7.56 6.06991 7.32 7.06991 7.32H7.55991C7.40321 7.93517 7.2863 8.5598 7.20991 9.19C6.70045 9.57537 6.21613 9.99288 5.75991 10.44C4.99991 9.44 4.77991 8.5 5.06991 8ZM5.06991 16C4.77991 15.5 5.06991 14.56 5.73991 13.53C6.19613 13.9771 6.68045 14.3946 7.18991 14.78C7.26631 15.4135 7.38322 16.0415 7.53991 16.66C6.29991 16.74 5.35991 16.5 5.06991 16ZM11.9999 4C12.5599 4 13.2299 4.66 13.7999 5.83C13.189 6.00731 12.5881 6.21762 11.9999 6.46C11.4117 6.21762 10.8109 6.00731 10.1999 5.83C10.7699 4.66 11.4399 4 11.9999 4ZM11.9999 20C11.4399 20 10.7699 19.34 10.1999 18.17C10.8109 17.9927 11.4117 17.7824 11.9999 17.54C12.5881 17.7824 13.189 17.9927 13.7999 18.17C13.2299 19.34 12.5599 20 11.9999 20ZM14.9299 13.69C14.4699 14.01 13.9999 14.31 13.4999 14.6C12.9999 14.89 12.4999 15.15 11.9999 15.38C11.4999 15.1467 10.9999 14.8867 10.4999 14.6C9.99991 14.31 9.49991 14.01 9.06991 13.69C8.99991 13.15 8.99991 12.59 8.99991 12C8.99991 11.41 8.99991 10.85 9.06991 10.31C9.52991 9.99 9.99991 9.69 10.4999 9.4C10.9999 9.11 11.4999 8.85 11.9999 8.62C12.4999 8.85333 12.9999 9.11333 13.4999 9.4C13.9999 9.69 14.4999 9.99 14.9299 10.31C14.9299 10.85 14.9999 11.41 14.9999 12C14.9999 12.59 14.9999 13.15 14.9299 13.69ZM18.9299 16C18.6399 16.5 17.6999 16.75 16.4599 16.66C16.6166 16.0415 16.7335 15.4135 16.8099 14.78C17.3194 14.3946 17.8037 13.9771 18.2599 13.53C18.9999 14.56 19.2199 15.5 18.9299 16ZM18.2599 10.47C17.8037 10.0229 17.3194 9.60537 16.8099 9.22C16.7335 8.5898 16.6166 7.96517 16.4599 7.35H16.9499C17.9499 7.35 18.6799 7.59 18.9499 8.03C19.2199 8.47 18.9999 9.44 18.2599 10.47Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/2 px-4 mb-20 lg:mb-0" x-show="slide === 1" x-cloak>
                    <div class="max-w-sm xs:max-w-xl">
                        <h2
                            class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-8">
                            Privacy-first
                        </h2>
                        <p class="text-xl text-gray-400 mb-4">
                            Your code can be hosted in your own GitHub / Gitlab or Bitbucket repositories. Codex will
                            establish a connection to your repository and start documenting your code.
                        </p>
                        <p class="text-xl text-gray-400 mb-8">
                            Once Codex receives the code, it will be stored in your own server and it will use a
                            locally-running Large Language Model (LLM) to generate the documentation. This way, your
                            code will never leave your server and you will have maximum privacy.
                        </p>
                        <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-violet-500 bg-transparent hover:bg-white border-2 border-white transition duration-200 rounded-full"
                            href="#cta">
                            <span class="mr-2">GET IN TOUCH</span>
                            <span class="animate-spinSlow group-hover:animate-none">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.9999 11C11.8021 11 11.6088 11.0586 11.4443 11.1685C11.2799 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.153 12.5673 11.2928 12.7071C11.4327 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1999 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8314 12.5556C12.9413 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8946 11.4804 12.707 11.2929C12.5195 11.1054 12.2651 11 11.9999 11ZM19.6199 12L19.7299 11.86C21.0799 10 21.3999 8.29 20.6599 7C19.9199 5.71 18.2599 5.14 15.9999 5.37H15.8199C14.9099 3.3 13.5599 2 11.9999 2C10.4399 2 9.08991 3.3 8.18991 5.4L7.99991 5.37C5.73991 5.14 4.07991 5.71 3.33991 7C2.59991 8.29 2.91991 10 4.26991 11.86L4.37991 12L4.26991 12.14C2.91991 14 2.59991 15.71 3.33991 17C3.99991 18.1 5.26991 18.68 6.99991 18.68C7.30991 18.68 7.62991 18.68 7.99991 18.63H8.17991C9.08991 20.7 10.4399 22 11.9999 22C13.5599 22 14.9099 20.7 15.8099 18.6H15.9899C16.3299 18.6 16.6499 18.65 16.9899 18.65C18.7599 18.65 20.0599 18.07 20.6899 16.97C21.4299 15.68 21.1099 13.97 19.7599 12.11L19.6199 12ZM5.06991 8C5.31991 7.56 6.06991 7.32 7.06991 7.32H7.55991C7.40321 7.93517 7.2863 8.5598 7.20991 9.19C6.70045 9.57537 6.21613 9.99288 5.75991 10.44C4.99991 9.44 4.77991 8.5 5.06991 8ZM5.06991 16C4.77991 15.5 5.06991 14.56 5.73991 13.53C6.19613 13.9771 6.68045 14.3946 7.18991 14.78C7.26631 15.4135 7.38322 16.0415 7.53991 16.66C6.29991 16.74 5.35991 16.5 5.06991 16ZM11.9999 4C12.5599 4 13.2299 4.66 13.7999 5.83C13.189 6.00731 12.5881 6.21762 11.9999 6.46C11.4117 6.21762 10.8109 6.00731 10.1999 5.83C10.7699 4.66 11.4399 4 11.9999 4ZM11.9999 20C11.4399 20 10.7699 19.34 10.1999 18.17C10.8109 17.9927 11.4117 17.7824 11.9999 17.54C12.5881 17.7824 13.189 17.9927 13.7999 18.17C13.2299 19.34 12.5599 20 11.9999 20ZM14.9299 13.69C14.4699 14.01 13.9999 14.31 13.4999 14.6C12.9999 14.89 12.4999 15.15 11.9999 15.38C11.4999 15.1467 10.9999 14.8867 10.4999 14.6C9.99991 14.31 9.49991 14.01 9.06991 13.69C8.99991 13.15 8.99991 12.59 8.99991 12C8.99991 11.41 8.99991 10.85 9.06991 10.31C9.52991 9.99 9.99991 9.69 10.4999 9.4C10.9999 9.11 11.4999 8.85 11.9999 8.62C12.4999 8.85333 12.9999 9.11333 13.4999 9.4C13.9999 9.69 14.4999 9.99 14.9299 10.31C14.9299 10.85 14.9999 11.41 14.9999 12C14.9999 12.59 14.9999 13.15 14.9299 13.69ZM18.9299 16C18.6399 16.5 17.6999 16.75 16.4599 16.66C16.6166 16.0415 16.7335 15.4135 16.8099 14.78C17.3194 14.3946 17.8037 13.9771 18.2599 13.53C18.9999 14.56 19.2199 15.5 18.9299 16ZM18.2599 10.47C17.8037 10.0229 17.3194 9.60537 16.8099 9.22C16.7335 8.5898 16.6166 7.96517 16.4599 7.35H16.9499C17.9499 7.35 18.6799 7.59 18.9499 8.03C19.2199 8.47 18.9999 9.44 18.2599 10.47Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/2 px-4 mb-20 lg:mb-0" x-show="slide === 2" x-cloak>
                    <div class="max-w-sm xs:max-w-xl">
                        <h2
                            class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-8">
                            Lifetime updates
                        </h2>
                        <p class="text-xl text-gray-400 mb-4">
                            Once you purchase a CodexB2B license, you will have access to all future updates over the
                            modules you have purchased. This may include new features, support for new languages or
                            framework versions, bug fixes, security and
                            performance updates.
                        </p>
                        <p class="text-xl text-gray-400 mb-8">
                            Updates will be served over internet and you will be able to install
                            them with a single click.
                        </p>
                        <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-violet-500 bg-transparent hover:bg-white border-2 border-white transition duration-200 rounded-full"
                            href="#cta">
                            <span class="mr-2">GET IN TOUCH</span>
                            <span class="animate-spinSlow group-hover:animate-none">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.9999 11C11.8021 11 11.6088 11.0586 11.4443 11.1685C11.2799 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.153 12.5673 11.2928 12.7071C11.4327 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1999 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8314 12.5556C12.9413 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8946 11.4804 12.707 11.2929C12.5195 11.1054 12.2651 11 11.9999 11ZM19.6199 12L19.7299 11.86C21.0799 10 21.3999 8.29 20.6599 7C19.9199 5.71 18.2599 5.14 15.9999 5.37H15.8199C14.9099 3.3 13.5599 2 11.9999 2C10.4399 2 9.08991 3.3 8.18991 5.4L7.99991 5.37C5.73991 5.14 4.07991 5.71 3.33991 7C2.59991 8.29 2.91991 10 4.26991 11.86L4.37991 12L4.26991 12.14C2.91991 14 2.59991 15.71 3.33991 17C3.99991 18.1 5.26991 18.68 6.99991 18.68C7.30991 18.68 7.62991 18.68 7.99991 18.63H8.17991C9.08991 20.7 10.4399 22 11.9999 22C13.5599 22 14.9099 20.7 15.8099 18.6H15.9899C16.3299 18.6 16.6499 18.65 16.9899 18.65C18.7599 18.65 20.0599 18.07 20.6899 16.97C21.4299 15.68 21.1099 13.97 19.7599 12.11L19.6199 12ZM5.06991 8C5.31991 7.56 6.06991 7.32 7.06991 7.32H7.55991C7.40321 7.93517 7.2863 8.5598 7.20991 9.19C6.70045 9.57537 6.21613 9.99288 5.75991 10.44C4.99991 9.44 4.77991 8.5 5.06991 8ZM5.06991 16C4.77991 15.5 5.06991 14.56 5.73991 13.53C6.19613 13.9771 6.68045 14.3946 7.18991 14.78C7.26631 15.4135 7.38322 16.0415 7.53991 16.66C6.29991 16.74 5.35991 16.5 5.06991 16ZM11.9999 4C12.5599 4 13.2299 4.66 13.7999 5.83C13.189 6.00731 12.5881 6.21762 11.9999 6.46C11.4117 6.21762 10.8109 6.00731 10.1999 5.83C10.7699 4.66 11.4399 4 11.9999 4ZM11.9999 20C11.4399 20 10.7699 19.34 10.1999 18.17C10.8109 17.9927 11.4117 17.7824 11.9999 17.54C12.5881 17.7824 13.189 17.9927 13.7999 18.17C13.2299 19.34 12.5599 20 11.9999 20ZM14.9299 13.69C14.4699 14.01 13.9999 14.31 13.4999 14.6C12.9999 14.89 12.4999 15.15 11.9999 15.38C11.4999 15.1467 10.9999 14.8867 10.4999 14.6C9.99991 14.31 9.49991 14.01 9.06991 13.69C8.99991 13.15 8.99991 12.59 8.99991 12C8.99991 11.41 8.99991 10.85 9.06991 10.31C9.52991 9.99 9.99991 9.69 10.4999 9.4C10.9999 9.11 11.4999 8.85 11.9999 8.62C12.4999 8.85333 12.9999 9.11333 13.4999 9.4C13.9999 9.69 14.4999 9.99 14.9299 10.31C14.9299 10.85 14.9999 11.41 14.9999 12C14.9999 12.59 14.9999 13.15 14.9299 13.69ZM18.9299 16C18.6399 16.5 17.6999 16.75 16.4599 16.66C16.6166 16.0415 16.7335 15.4135 16.8099 14.78C17.3194 14.3946 17.8037 13.9771 18.2599 13.53C18.9999 14.56 19.2199 15.5 18.9299 16ZM18.2599 10.47C17.8037 10.0229 17.3194 9.60537 16.8099 9.22C16.7335 8.5898 16.6166 7.96517 16.4599 7.35H16.9499C17.9499 7.35 18.6799 7.59 18.9499 8.03C19.2199 8.47 18.9999 9.44 18.2599 10.47Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="relative w-full lg:w-1/2 px-4 mb-20 lg:mb-0" x-show="slide === 3" x-cloak>
                    <div class="max-w-sm xs:max-w-xl">
                        <h2
                            class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-8">
                            Extensibility
                        </h2>
                        <p class="text-xl text-gray-400 mb-4">
                            We are constantly improving Codex with the latest advancements of AI. This means we may
                            create new modules (i.e. video-based documentation, feature planning,
                            etc.) that you can add to your Codex installation by paying a one-time fee.
                        </p>
                        <p class="text-xl text-gray-400 mb-8">
                            You will be able to purchase these modules and install them with a single click. Also, we
                            are
                            developing an API so you can create your own modules and integrate them with
                            Codex.
                        </p>
                        <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-violet-500 bg-transparent hover:bg-white border-2 border-white transition duration-200 rounded-full"
                            href="#cta">
                            <span class="mr-2">GET IN TOUCH</span>
                            <span class="animate-spinSlow group-hover:animate-none">
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.9999 11C11.8021 11 11.6088 11.0586 11.4443 11.1685C11.2799 11.2784 11.1517 11.4346 11.076 11.6173C11.0003 11.8 10.9805 12.0011 11.0191 12.1951C11.0577 12.3891 11.153 12.5673 11.2928 12.7071C11.4327 12.847 11.6108 12.9422 11.8048 12.9808C11.9988 13.0194 12.1999 12.9996 12.3826 12.9239C12.5653 12.8482 12.7215 12.72 12.8314 12.5556C12.9413 12.3911 12.9999 12.1978 12.9999 12C12.9999 11.7348 12.8946 11.4804 12.707 11.2929C12.5195 11.1054 12.2651 11 11.9999 11ZM19.6199 12L19.7299 11.86C21.0799 10 21.3999 8.29 20.6599 7C19.9199 5.71 18.2599 5.14 15.9999 5.37H15.8199C14.9099 3.3 13.5599 2 11.9999 2C10.4399 2 9.08991 3.3 8.18991 5.4L7.99991 5.37C5.73991 5.14 4.07991 5.71 3.33991 7C2.59991 8.29 2.91991 10 4.26991 11.86L4.37991 12L4.26991 12.14C2.91991 14 2.59991 15.71 3.33991 17C3.99991 18.1 5.26991 18.68 6.99991 18.68C7.30991 18.68 7.62991 18.68 7.99991 18.63H8.17991C9.08991 20.7 10.4399 22 11.9999 22C13.5599 22 14.9099 20.7 15.8099 18.6H15.9899C16.3299 18.6 16.6499 18.65 16.9899 18.65C18.7599 18.65 20.0599 18.07 20.6899 16.97C21.4299 15.68 21.1099 13.97 19.7599 12.11L19.6199 12ZM5.06991 8C5.31991 7.56 6.06991 7.32 7.06991 7.32H7.55991C7.40321 7.93517 7.2863 8.5598 7.20991 9.19C6.70045 9.57537 6.21613 9.99288 5.75991 10.44C4.99991 9.44 4.77991 8.5 5.06991 8ZM5.06991 16C4.77991 15.5 5.06991 14.56 5.73991 13.53C6.19613 13.9771 6.68045 14.3946 7.18991 14.78C7.26631 15.4135 7.38322 16.0415 7.53991 16.66C6.29991 16.74 5.35991 16.5 5.06991 16ZM11.9999 4C12.5599 4 13.2299 4.66 13.7999 5.83C13.189 6.00731 12.5881 6.21762 11.9999 6.46C11.4117 6.21762 10.8109 6.00731 10.1999 5.83C10.7699 4.66 11.4399 4 11.9999 4ZM11.9999 20C11.4399 20 10.7699 19.34 10.1999 18.17C10.8109 17.9927 11.4117 17.7824 11.9999 17.54C12.5881 17.7824 13.189 17.9927 13.7999 18.17C13.2299 19.34 12.5599 20 11.9999 20ZM14.9299 13.69C14.4699 14.01 13.9999 14.31 13.4999 14.6C12.9999 14.89 12.4999 15.15 11.9999 15.38C11.4999 15.1467 10.9999 14.8867 10.4999 14.6C9.99991 14.31 9.49991 14.01 9.06991 13.69C8.99991 13.15 8.99991 12.59 8.99991 12C8.99991 11.41 8.99991 10.85 9.06991 10.31C9.52991 9.99 9.99991 9.69 10.4999 9.4C10.9999 9.11 11.4999 8.85 11.9999 8.62C12.4999 8.85333 12.9999 9.11333 13.4999 9.4C13.9999 9.69 14.4999 9.99 14.9299 10.31C14.9299 10.85 14.9999 11.41 14.9999 12C14.9999 12.59 14.9999 13.15 14.9299 13.69ZM18.9299 16C18.6399 16.5 17.6999 16.75 16.4599 16.66C16.6166 16.0415 16.7335 15.4135 16.8099 14.78C17.3194 14.3946 17.8037 13.9771 18.2599 13.53C18.9999 14.56 19.2199 15.5 18.9299 16ZM18.2599 10.47C17.8037 10.0229 17.3194 9.60537 16.8099 9.22C16.7335 8.5898 16.6166 7.96517 16.4599 7.35H16.9499C17.9499 7.35 18.6799 7.59 18.9499 8.03C19.2199 8.47 18.9999 9.44 18.2599 10.47Z"
                                        fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex flex-wrap -mx-4 -mb-12 items-start mt-12">
                <button type="button" x-on:click="slide = 0" class="w-full md:w-1/2 lg:w-1/4 px-4 mb-12">
                    <div class="max-w-md mx-auto md:max-w-none pt-8 border-t-2 border-white border-opacity-20"
                        x-bind:class="{
                            'border-violet-700 text-white': slide === 0,
                            'text-gray-700 border-white border-opacity-20': slide !== 0,
                        }">
                        <span class="text-xl font-medium">01. What will you get</span>
                    </div>
                </button>
                <button type="button" x-on:click="slide = 1" class="w-full md:w-1/2 lg:w-1/4 px-4 mb-12">
                    <div class="max-w-md mx-auto md:max-w-none pt-8 border-t-2 border-violet-700"
                        x-bind:class="{
                            'border-violet-700 text-white': slide === 1,
                            'text-gray-700 border-white border-opacity-20': slide !== 1,
                        }">
                        <span class="block text-xl font-medium">02. Privacy-first documentation</span>
                    </div>
                </button>
                <button type="button" x-on:click="slide = 2" class="w-full md:w-1/2 lg:w-1/4 px-4 mb-12">
                    <div class="max-w-md mx-auto md:max-w-none pt-8 border-t-2 border-white border-opacity-20"
                        x-bind:class="{
                            'border-violet-700 text-white': slide === 2,
                            'text-gray-700 border-white border-opacity-20': slide !== 2,
                        }">
                        <span class="text-xl font-medium">03. Lifetime updates</span>
                    </div>
                </button>
                <button type="button" x-on:click="slide = 3" class="w-full md:w-1/2 lg:w-1/4 px-4 mb-12">
                    <div class="max-w-md mx-auto md:max-w-none pt-8 border-t-2 border-white border-opacity-20"
                        x-bind:class="{
                            'border-violet-700 text-white': slide === 3,
                            'text-gray-700 border-white border-opacity-20': slide !== 3,
                        }">
                        <span class="text-xl font-medium">04. Extensibility</span>
                    </div>
                </button>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 bg-body overflow-hidden" id="best-in-class-documentation">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 right-0 -mr-52 -mt-64 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div class="relative mx-auto lg:mx-0 mb-32">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl lg:text-7xl font-medium text-white tracking-tight mb-6">
                    Best-in-class documentation
                </h2>
                <p class="max-w-4xl text-xl text-newGray-500 tracking-tight">
                    We are constantly improving CodexAtlas and keeping it up-to-date with the latest versions of each
                    framework and language. But we are also doing some other cool stuff that will be available soon.
                </p>
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
                                        On-premise code documentation
                                    </h3>
                                    <p class="text-violet-100 tracking-tight leading-5">
                                        Your code is something really private. Everything runs on your own server and
                                        only you can read it.
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
                                        Self-host your docs
                                    </h2>
                                    <p class="text-violet-100 tracking-tight leading-5">
                                        Synchronize your documentation to Confluence, GitHub Wiki, Gitlab Wiki and
                                        Notion, or download it in Markdown format.
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
                                        Intelligent copilot
                                    </h3>
                                    <p class="text-violet-100 tracking-tight leading-5">
                                        We want to reduce the time
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
                <div class="text-center mt-12">
                    <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                        href="#cta">
                        <span class="mr-2">{{ __('GET IN TOUCH') }}</span>
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
    </section>

    <section class="relative pt-12 md:pt-24 lg:py-36 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 right-0 -mt-32 -mr-40 w-64 h-64 bg-gradient-to-t from-blue-500 to-darkBlue-900 rounded-full filter blur-4xl">
            </div>
            <div class="max-w-md lg:max-w-xs xl:max-w-md 2xl:max-w-xl mx-auto text-center">
                <h2 class="font-heading text-4xl xl:text-5xl 2xl:text-6xl font-medium text-white tracking-tight mb-8">
                    We support your framework
                </h2>
                <p class="max-w-md mx-auto text-lg text-gray-500 tracking-tight mb-8">
                    We are already prepared to work with most of the popular frameworks and languages. If you are using
                    a different one, we can do the integration for you.
                </p>
                <a class="group inline-flex w-full sm:w-auto h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-violet-800 bg-violet-500 hover:bg-white transition duration-200 rounded-full"
                    href="#cta">
                    <span class="mr-2">GET IN TOUCH</span>
                    <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                            fill="currentColor"></path>
                    </svg>
                </a>
            </div>
        </div>
        <div class="relative lg:hidden py-10 max-w-xl mx-auto mt-20">
            <div
                class="absolute z-10 top-0 left-0 w-full h-40 bg-gradient-to-b from-darkBlue-900 via-darkBlue-900 to-transparent opacity-90">
            </div>
            <div
                class="absolute z-10 bottom-0 left-0 w-full h-40 bg-gradient-to-t from-darkBlue-900 via-darkBlue-900 to-transparent opacity-90">
            </div>
            <div class="px-8">
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full xs:hidden xs:w-1/2 xs:-mb-5 px-4 space-y-6">
                        @foreach (array_slice(\App\Atlas\Guesser::supportedFrameworks(), 0, 12) as $framework)
                            <div
                                class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                <img class="block h-8 mx-auto" src="{{ $framework->imageUrl() }}"
                                    alt="{{ $framework->name() }}">
                            </div>
                        @endforeach
                    </div>
                    <div class="w-full hidden xs:block xs:w-1/2 xs:-mb-5 px-4 space-y-6">
                        @foreach (array_slice(\App\Atlas\Guesser::supportedFrameworks(), 0, 12) as $framework)
                            @if ($loop->even)
                                <div
                                    class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                    <img class="block h-8 mx-auto" src="{{ $framework->imageUrl() }}"
                                        alt="{{ $framework->name() }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                    <div class="hidden xs:block w-full xs:w-1/2 px-4 xs:-mt-5 space-y-6">
                        @foreach (array_slice(\App\Atlas\Guesser::supportedFrameworks(), 0, 12) as $framework)
                            @if ($loop->odd)
                                <div
                                    class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                    <img class="block h-8 mx-auto" src="{{ $framework->imageUrl() }}"
                                        alt="{{ $framework->name() }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="hidden lg:block absolute top-0 left-0 h-full w-full lg:max-w-sm 2xl:max-w-md px-8">
            <div
                class="hidden xs:block absolute z-10 top-0 left-0 w-full h-20 lg:h-32 bg-gradient-to-b from-darkBlue-900 via-darkBlue-900 to-transparent opacity-90">
            </div>
            <div
                class="hidden xs:block absolute z-10 bottom-0 left-0 w-full h-20 lg:h-32 bg-gradient-to-t from-darkBlue-900 via-darkBlue-900 to-transparent opacity-90">
            </div>
            <div class="flex flex-wrap -mx-4">
                <div class="w-full xs:w-1/2 -mb-5 px-4 space-y-6">
                    @foreach (array_slice(\App\Atlas\Guesser::supportedFrameworks(), 0, 12) as $framework)
                        @if ($loop->odd)
                            <div
                                class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                <img class="block h-8 mx-auto" src="{{ $framework->imageUrl() }}"
                                    alt="{{ $framework->name() }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="w-full xs:w-1/2 px-4 -mt-5 space-y-6">
                    @foreach (array_slice(\App\Atlas\Guesser::supportedFrameworks(), 0, 12) as $framework)
                        @if ($loop->even)
                            <div
                                class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                <img class="block h-8 mx-auto" src="{{ $framework->imageUrl() }}"
                                    alt="{{ $framework->name() }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <div class="hidden lg:block absolute top-0 right-0 h-full w-full lg:max-w-sm 2xl:max-w-md px-8 z-10">
            <div
                class="hidden xs:block absolute z-10 top-0 left-0 w-full h-20 lg:h-32 bg-gradient-to-b from-darkBlue-900 via-darkBlue-900 to-transparent opacity-90">
            </div>
            <div
                class="hidden xs:block absolute z-10 bottom-0 left-0 w-full h-20 lg:h-32 bg-gradient-to-t from-darkBlue-900 via-darkBlue-900 to-transparent opacity-90">
            </div>
            <div class="flex flex-wrap -mx-4 -mb-8">
                <div class="w-full xs:w-1/2 -mb-5 px-4 space-y-6">
                    @foreach (\App\Atlas\Guesser::supportedLanguages() as $language)
                        @if ($loop->even)
                            <div
                                class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                <img class="block h-8 mx-auto" src="{{ $language->imageUrl() }}"
                                    alt="{{ $language->name() }}">
                            </div>
                        @endif
                    @endforeach
                </div>
                <div class="w-full xs:w-1/2 px-4 -mt-5 space-y-6">
                    @foreach (\App\Atlas\Guesser::supportedLanguages() as $language)
                        @if ($loop->odd)
                            <div
                                class="px-6 py-6 rounded-3xl shadow-box-violet overflow-hidden bg-white bg-opacity-20">
                                <img class="block h-8 mx-auto" src="{{ $language->imageUrl() }}"
                                    alt="{{ $language->name() }}">
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:py-24 lg:py-32 bg-body overflow-hidden" id="cta">
        <div class="relative container mx-auto px-4">
            <div
                class="absolute top-0 left-0 -mt-52 -ml-32 w-186 h-186 bg-gradient-to-t from-purple-600 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
            </div>
            <div
                class="absolute bottom-0 right-0 mb-40 -mr-52 w-186 h-186 bg-gradient-to-t from-blue-500 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
            </div>
            <div class="relative max-w-2xl mx-auto mb-14 text-center">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl xl:text-7xl font-medium text-white tracking-tight mb-4">
                    Let's talk business
                </h2>
            </div>
            <div class="relative max-w-md lg:max-w-6xl mx-auto p-5 rounded-3xl overflow-hidden">
                <div
                    class="absolute top-0 left-0 w-full h-full backdrop-filter backdrop-blur-md bg-gray-500 bg-opacity-20 group-hover:bg-violet-400 group-hover:bg-opacity-100 transition duration-150">
                </div>
                <livewire:enterprise-calculator />
            </div>
        </div>
    </section>
</x-web-layout>
