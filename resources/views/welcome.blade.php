<x-web-layout>
    @section('title', 'Code documentation automated with AI | CodexAtlas')
    <div class="relative pt-24 pb-40">
        <div class="relative z-10 container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="max-w-lg mx-auto lg:max-w-6xl text-center">
                    <div class="flex justify-center">
                        <h1
                            class="border border-darkBlue-600 rounded-full px-4 py-2 text-xs uppercase text-darkBlue-200">
                            Create code documentation using AI
                        </h1>
                    </div>
                    <p
                        class="font-heading text-4xl mt-4 sm:text-6xl md:text-6xl xl:text-[5rem] text-white font-semibold leading-none mb-8">
                        Get back 32 development hours every month
                    </p>
                    <p class="text-2xl text-newGray-400 mb-8">
                        Developers spend on average 20% of their time writing documentation. CodexAtlas takes care of
                        the documentation for them, so your developers can focus on shipping.
                    </p>
                    <div
                        class="flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                        @if (paymentIsWithAws())
                            <a class="w-full group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full sm:w-auto"
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
                            <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                href="#pricing">
                                <span class="mr-2">{{ __('Start documenting your code') }}</span>
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <span class="text-darkBlue-200">or</span>
                            <a class="text-base font-medium text-white hover:underline"
                                href="{{ route('tools.code-documentation', ['language' => 'python']) }}">
                                {{ __('Try our free tool') }}
                            </a>
                        @endif
                    </div>
                    <div
                        class="mt-12 text-darkBlue-200 font-bold flex flex-col items-center justify-center gap-8 md:flex-row">
                        <span>
                            {{ number_format(cache()->remember('processed-files-v1', now()->addHour(), fn() => \App\Models\ProcessingLogEntry::count() * 10), 0) }}+
                            files already documented
                        </span>
                        <span class="text-amber-500 flex justify-start flex-shrink-0">
                            <x-codex.icons.star class="w-4 h-4" />
                            <x-codex.icons.star class="w-4 h-4" />
                            <x-codex.icons.star class="w-4 h-4" />
                            <x-codex.icons.star class="w-4 h-4" />
                            <x-codex.icons.star class="w-4 h-4" />
                        </span>
                    </div>
                    <div class="border-[1rem] border-darkBlue-700 rounded-xl mt-12">
                        <img src="{{ asset('images/screenshot.png') }}" alt="Screenshot of CodexAtlas" />
                    </div>
                    <p class="mt-8 text-sm text-darkBlue-200">With special thanks to:</p>
                    <div class="mt-2 flex flex-wrap gap-8 items-center justify-center">
                        <img src="https://upload.wikimedia.org/wikipedia/commons/9/93/Amazon_Web_Services_Logo.svg"
                            alt="AWS" class="h-12 w-auto flex-shrink-0 brightness-0 invert" />
                        <img src="{{ asset('logos/msforstartups.png') }}" alt="AWS"
                            class="h-16 w-auto flex-shrink-0 brightness-0 invert" />
                        <img src="https://borah.digital/logo.png" alt="Borah Digital Labs"
                            class="h-12 w-auto flex-shrink-0 brightness-0 invert" />
                        {{-- <img src="https://rlc-solutions.com/wp-content/uploads/2022/12/blanco-logo.png"
                            alt="RLC Solutions" class="h-10 w-auto flex-shrink-0 brightness-0 invert" />
                        <img src="https://citricamente.com/wp-content/uploads/2020/09/logo_Citricamente_B.png"
                            alt="Cítricamente" class="h-12 w-auto flex-shrink-0 brightness-0 invert" /> --}}
                    </div>
                </div>
            </div>
        </div>

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
                <div class="max-w-5xl mx-auto mb-16 text-center">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        Reduce the time spent on documentation to zero
                    </h2>
                    <p class="text-xl text-newGray-400">
                        CodexAtlas removes the manual work on documenting software projects by using the latest
                        advancements in Artificial Intelligence.
                    </p>
                </div>
                <div class="flex flex-wrap -mx-4">
                    <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                        <div class="max-w-md mx-auto h-full p-8 rounded-3xl overflow-hidden bg-white bg-opacity-10">
                            <div class="flex mb-12 items-center">
                                <div>
                                    <h3 class="text-2xl font-medium text-white leading-tight">
                                        Reduce onboarding time
                                    </h3>
                                </div>
                            </div>
                            <p class="text-xl text-darkBlue-100">
                                By always having the documentation up-to-date, new developers can start contributing to
                                the project faster.
                            </p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4 mb-8 lg:mb-0">
                        <div class="max-w-md mx-auto h-full p-8 rounded-3xl overflow-hidden bg-white bg-opacity-10">
                            <div class="flex mb-12 items-center">
                                <div>
                                    <h4 class="text-2xl font-medium text-white leading-tight">
                                        Reduce key-person risk
                                    </h4>
                                </div>
                            </div>
                            <p class="text-xl text-darkBlue-100">
                                Knowledge of the project will not be tied to a single person, reducing the risk of
                                losing key developers.
                            </p>
                        </div>
                    </div>
                    <div class="w-full lg:w-1/3 px-4">
                        <div class="max-w-md mx-auto h-full p-8 rounded-3xl overflow-hidden bg-white bg-opacity-10">
                            <div class="flex mb-12 items-center">
                                <div>
                                    <h3 class="text-2xl font-medium text-white leading-tight">
                                        Build more features
                                    </h3>
                                </div>
                            </div>
                            <p class="text-xl text-darkBlue-100">
                                Your developers can focus on building new features instead of writing documentation.
                            </p>
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
            <div class="max-w-5xl mx-auto mb-16 text-center relative">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                    Real-time, reliable and private
                </h2>
                <p class="text-xl text-newGray-400">
                    We've got it all covered. CodexAtlas is the best way to free your developers from writing
                    documentation.
                </p>
            </div>
            <div class="relative max-w-md lg:max-w-none mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <div class="w-full">
                        <div
                            class="group block h-full p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <h2 class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                    Real-time updates
                                </h2>
                                <p class="text-violet-100 tracking-tight leading-normal">
                                    The documentation is always up-to-date with the code, so you don't have to worry
                                    about it.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-full p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <h3 class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                    Bussiness knowledge
                                </h3>
                                <p class="text-violet-100 tracking-tight leading-normal">
                                    You can extend the documentation with business domain knowledge that is not
                                    present in the code.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-full p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <h3 class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                    Automatic READMEs
                                </h3>
                                <p class="text-violet-100 tracking-tight leading-normal">
                                    CodexAtlas can generate README files for your projects. You can try our <a
                                        href="{{ route('tools.readme-generator') }}" class="underline">free README
                                        generator</a> to get
                                    a glance.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="w-full">
                        <div
                            class="group block h-full p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <h3 class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                    Use-case docs
                                </h3>
                                <p class="text-violet-100 tracking-tight leading-normal">
                                    Most tools just create documentation for each file. CodexAtlas can detect use cases
                                    from your code and will generate <strong>video tutorials</strong> on how they work.
                                    (Feature in preview, reach out to support to enable it.)
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-full p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <h3 class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                    Code conversion
                                </h3>
                                <p class="text-violet-100 tracking-tight leading-normal">
                                    CodexAtlas can help you convert code from one language or framework to another. You
                                    can try our <a
                                        href="{{ route('tools.code-converter', ['from' => 'python', 'to' => 'javascript']) }}"
                                        class="underline">free code conversion tool</a> to get
                                    a glance.
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="w-full">
                        <div
                            class="group block h-full p-8 border-2 border-white border-opacity-10 hover:border-opacity-100 rounded-3xl transition duration-200">
                            <div class="flex h-full flex-col items-start">
                                <h3 class="text-3xl sm:text-4xl mb-2 font-medium text-white group-hover:text-sky-900">
                                    On-premise plan
                                </h3>
                                <p class="text-violet-100 tracking-tight leading-5">
                                    We understand that for some
                                    organizations, code is something really private. Reach out to us for an
                                    on-premise version so that your code will never leave your servers.
                                    <strong>One-time payment. Pay once, use forever.</strong>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center mt-12">
                    <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                        href="#pricing">
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
            <div class="grid gap-8 lg:gap-0 lg:flex justify-center items-center px-4 lg:px-0 mb-8">
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(1)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(3)" />
                <x-homepage.demo-project :project="\App\Demo\DemoList::get()->demo(5)" />
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
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl xl:text-7xl font-medium text-white tracking-tight mb-4">
                        Pay once per repo, document forever
                    </h2>
                </div>
                <div class="relative z-10 max-w-md lg:max-w-8xl mx-auto">
                    <div class="mb-12">
                        <livewire:enterprise-calculator :simpleMode="true" />
                    </div>
                    <div class="flex flex-wrap -mx-4">
                        @php
                            $monthlyPlan = \App\Cashier\StripePlanProvider::price(config('spark.billables.user.price'));
                        @endphp
                        <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-3.png')" price="Lifetime plan" :title="$monthlyPlan?->price . ' per repository'"
                            description="Best for small and medium-sized companies that want to integrate CodexAtlas with their workflow."
                            :included="[
                                'Real-time documentation updates',
                                'Unlimited branches',
                                'Unlimited files per branch',
                                'Unlimited custom knowledge',
                                'Unlimited code conversions',
                                'Automatic README files',
                            ]" :notIncluded="[]" cta="Get started" :ctaUrl="route('login')" />
                    </div>
                    <div class="relative mx-auto mb-8 p-10 rounded-3xl overflow-hidden mt-12 lg:mt-24">
                        <div
                            class="absolute top-0 left-0 w-full h-full backdrop-filter backdrop-blur-md bg-newGray-500 bg-opacity-20 group-hover:bg-violet-400 group-hover:bg-opacity-100 transition duration-150">
                        </div>
                        <div class="relative flex flex-wrap lg:flex-nowrap -mx-4 items-center">
                            <div class="w-full lg:w-auto px-4 mb-8 lg:mb-0">
                                <div class="lg:flex items-center">
                                    <img src="{{ asset('casper-assets/pricing/robot.png') }}" alt="">
                                    <div class="mt-3 sm:mt-0 sm:ml-8">
                                        <h3 class="text-3xl font-medium text-white">Enterprise</h3>
                                        <p class="text-sm text-newGray-300 max-w-lg mt-2">
                                            We can help you setup an on-premise system and save more than $20.000/year
                                            in documentation and onboarding costs.
                                        </p>
                                        <ul class="grid grid-cols-1 lg:grid-cols-3 gap-4 mt-4">
                                            <x-homepage.pricing-included text="On-premise system" />
                                            <x-homepage.pricing-included text="Custom integrations" />
                                            <x-homepage.pricing-included text="Custom SLA" />
                                            <x-homepage.pricing-included text="Dedicated support team" />
                                            <x-homepage.pricing-included class="lg:col-span-2"
                                                text="Custom, on-premise AI model (no data shared with OpenAI)" />
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full lg:w-auto ml-auto flex-shrink-0 px-4">
                                <div>
                                    <a class="group inline-flex w-auto h-14 px-7 items-center justify-center text-base font-medium text-black hover:text-violet-500 bg-violet-500 hover:bg-white transition duration-200 rounded-full"
                                        href="{{ route('enterprise') }}">
                                        <span class="mr-2">See how</span>
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
                <a href="https://{{ config('app.autodoc_domain') }}" target="_blank"
                    class="text-white block underline mt-12 text-center">
                    Looking for a one-time documentation? Check AutomaticDocs
                </a>
            </div>
        </section>
    @endif
    <section class="relative py-12 md:py-24 bg-body overflow-hidden">
        <div class="relative container mx-auto px-4">
            <div class="relative">
                <div class="max-w-5xl mx-auto mb-16 text-center relative">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        Any questions?
                    </h2>
                </div>
                <div class="relative w-full max-w-4xl mx-auto px-4">
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
