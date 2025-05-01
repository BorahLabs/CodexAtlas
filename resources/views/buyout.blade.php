<x-web-layout>
    @section('title', 'Code documentation automated with AI | CodexAtlas')
    <div class="relative pt-24 pb-40">
        <div class="relative z-10 container mx-auto px-4">
            <div class="flex flex-wrap items-center">
                <div class="max-w-lg mx-auto lg:max-w-6xl text-center">
                    <div class="flex justify-center">
                        <h1
                            class="border border-darkBlue-600 rounded-full px-4 py-2 text-xs uppercase text-darkBlue-200">
                            Important announcement
                        </h1>
                    </div>
                    <p
                        class="font-heading text-4xl mt-4 sm:text-6xl md:text-6xl xl:text-[5rem] text-white font-semibold leading-none mb-8">
                        We are selling CodexAtlas
                    </p>
                    <p class="text-2xl text-newGray-400 mb-8">
                        We are selling CodexAtlas to a company that will continue to invest in it.<br><strong class="text-white">Current price: {{  '$'.number_format(\App\Services\BuyoutService::getPrice(), 0, ',', '.') }}</strong>
                    </p>
                    <p class="text-2xl text-newGray-400 mb-8">
                        Starting on the 1st of May, 2025; we will start with a 40% offer by setting the price at 60.000$. After a month, it will raise to 100.000$, and then the price will decrease by 500$ every day, until it reaches 20.000$. First come, first served.
                    </p>
                    <div
                        class="flex flex-col items-center justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <a class="group inline-flex h-14 px-7 items-center justify-center text-base font-medium text-white hover:text-white bg-violet-500 hover:bg-violet-600 transition duration-200 rounded-full"
                                href="#pricing">
                                Purchase now
                                <svg width="24" height="24" viewbox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M17.9199 6.62C17.8185 6.37565 17.6243 6.18147 17.3799 6.08C17.2597 6.02876 17.1306 6.00158 16.9999 6H6.99994C6.73472 6 6.48037 6.10536 6.29283 6.29289C6.1053 6.48043 5.99994 6.73478 5.99994 7C5.99994 7.26522 6.1053 7.51957 6.29283 7.70711C6.48037 7.89464 6.73472 8 6.99994 8H14.5899L6.28994 16.29C6.19621 16.383 6.12182 16.4936 6.07105 16.6154C6.02028 16.7373 5.99414 16.868 5.99414 17C5.99414 17.132 6.02028 17.2627 6.07105 17.3846C6.12182 17.5064 6.19621 17.617 6.28994 17.71C6.3829 17.8037 6.4935 17.8781 6.61536 17.9289C6.73722 17.9797 6.86793 18.0058 6.99994 18.0058C7.13195 18.0058 7.26266 17.9797 7.38452 17.9289C7.50638 17.8781 7.61698 17.8037 7.70994 17.71L15.9999 9.41V17C15.9999 17.2652 16.1053 17.5196 16.2928 17.7071C16.4804 17.8946 16.7347 18 16.9999 18C17.2652 18 17.5195 17.8946 17.707 17.7071C17.8946 17.5196 17.9999 17.2652 17.9999 17V7C17.9984 6.86932 17.9712 6.74022 17.9199 6.62Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <span class="text-darkBlue-200">or</span>
                            <a class="text-base font-medium text-white hover:underline"
                                href="#why">
                                Learn more
                            </a>
                    </div>
                    <a class="text-base font-medium text-white hover:underline block mt-8"
                        href="{{ session()->get('redirect_to') ?: request()->redirect_to ?: route('homepage') }}?skip_buyout=true&redirect_to={{ urlencode(session()->get('redirect_to') ?: request()->redirect_to ?: route('homepage')) }}">
                        Not interested? Go back to our website
                    </a>
                </div>
            </div>
        </div>
    </div>

    <section class="relative py-12 md:py-24 bg-body overflow-hidden" id="why">
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
                        Why?
                    </h2>
                    <p class="text-xl text-newGray-200">
                        TLDR; We had fun developing CodexAtlas, but we've had other priorities in <a href="https://borah.digital/" target="_blank" class="text-white underline">our agency</a> and we haven't been able to put effort into marketing.
                    </p>
                    <p class="text-xl text-newGray-200 mt-4">
                        We believe it's a great product and it has potential to create value for a lot of people. Other similar products, like Docuwriter, <a href="https://www.indiehackers.com/magarrent" target="_blank" class="text-white underline">are now making ~7.000€/month</a>, while we are at 0€/month.
                    </p>
                </div>
            </div>
        </div>
    </section>
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
                <div class="max-w-5xl mx-auto mb-16 text-left">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        What's the current status?
                    </h2>
                    <div class="space-y-4">
                        <p class="text-xl text-newGray-200">
                            The platform is still working, but we haven't added any new features in a while. We are getting ~450 people each month into the website but we haven't had any conversions. <a href="https://app.usefathom.com/share/fepwqlxw/codexatlas" target="_blank" class="text-white underline">Check our statistics dashboard</a>.
                        </p>
                        <p class="text-xl text-newGray-200">
                            I'll talk a bit about how it's built. It's a Laravel application using the TALL Stack (TailwindCSS, AlpineJS, Livewire and Laravel).
                        </p>
                        <p class="text-xl text-newGray-200">
                            The app is currently running on a single server which costs ~10$/month. It was running before in Laravel Vapor for scalability, but we weren't giving it any attention and it was costing us money. I will help you migrate to your own server / Laravel Cloud.
                        </p>
                        <p class="text-xl text-newGray-200">
                            Codex works using OpenAI right now, but it's prepared to use other LLM providers with minimal effort. Also, it's capable of using local models or custom models through <a href="https://modal.com/" target="_blank" class="text-white underline">Modal</a>.
                        </p>
                        <p class="text-xl text-newGray-200">
                            It's also integrated with GitHub, Gitlab and Bitbucket, and it's capable of getting the code from the repositories and generating the documentation automatically.
                        </p>
                        <p class="text-xl text-newGray-200">
                            The payment system currently is handled by Stripe, although there's some .env variables that you can use to set it up in AWS, but some work would be needed here (especially in AWS to setup everything).
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                <div class="max-w-5xl mx-auto mb-16 text-left">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        Do we believe it has potential?
                    </h2>
                    <div class="space-y-4">
                        <p class="text-xl text-newGray-200">
                            Yes, we always did. However, current AI advancements makes it easier to generate better documentation (i.e. using Gemini with the longer context window), or making audio documentation using OpenAI.
                        </p>
                        <p class="text-xl text-newGray-200">
                            We also have some half-baked features and ideas that we didn't have time to finish: Alexandria, a feature that allows you to ask questions about the codebase and get the answer, or a pull request assistant.
                        </p>
                        <p class="text-xl text-newGray-200">
                            Most of our visitors are coming from search engines, and we haven't done a good job at SEO. Most of the visits come looking for free tools, so it would probably be worth to focus on growing those tools and not only in the documentation side.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
                <div class="max-w-5xl mx-auto mb-16 text-left">
                    <h2
                        class="font-heading text-4xl xs:text-5xl sm:text-6xl md:text-7xl font-medium text-white tracking-tight mb-6">
                        What's included if I buy it?
                    </h2>
                    <div class="space-y-4">
                        <p class="text-xl text-newGray-200">
                            Everything, including the branding, code and the domain. We will help you migrate the code to your own server or Laravel Cloud (recommended), and we will transfer the domain to you.
                        </p>
                        <p class="text-xl text-newGray-200">
                            There's also another domain, <a href="http://automaticdocs.app/" target="_blank" class="text-white underline">automaticdocs.app</a>, that will be included in the purchase and runs the same codebase in a different domain for a different audience.
                        </p>
                        <p class="text-xl text-newGray-200">
                            Just by changing some environment variables you can also start using your own OpenAI account and your own Stripe account.
                        </p>
                        <p class="text-xl text-newGray-200">
                            Even though it's making no sales, the codebase is pretty big and you can save a lot of development time by buying it. We've invested a lot on the design, branding and development of the product.
                        </p>
                        <p class="text-xl text-newGray-200">
                            We will *not* provide any free development on the codebase after the purchase. We will help you get the app up and running, but please note that there might be some bugs that we haven't found yet, although there's a strong testing set in place.
                        </p>
                        <p class="text-xl text-newGray-200">
                            I'll give you my personal email so you can reach out anytime and I'll be happy to guide you or answer any questions you might have after you ahve the project on your end. I know my way around the codebase pretty well and I also got a lot of experience by trying to get the product to scale.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="relative py-12 md:pb-24 lg:pb-32 bg-body overflow-hidden" id="pricing">
        <div class="relative container mx-auto px-4 z-10">
            <div
                class="absolute top-0 left-0 -mt-40 -ml-52 w-186 z-10 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
            </div>
            <div class="relative z-10 max-w-2xl mx-auto mb-14 text-center">
                <h2
                    class="font-heading text-4xl xs:text-5xl sm:text-6xl xl:text-7xl font-medium text-white tracking-tight mb-4">
                    Buy it now
                </h2>
            </div>
            <div class="relative z-10 max-w-md lg:max-w-8xl mx-auto">
                <div class="flex flex-wrap -mx-4">
                    <x-homepage.pricing-card :imageUrl="asset('casper-assets/pricing/pricing-top-1.png')"
                        :price="'$'.number_format(\App\Services\BuyoutService::getPrice(), 0, ',', '.')"
                        :title="\App\Services\BuyoutService::isAuctionActive() ? 'Auction' : 'Take the offer now'"
                        description="We will redirect you to a secure payment page to complete the purchase. Then, we will reach out to you to start the migration."
                        :included="[
                            '1-week setup time',
                            'All codebase and assets',
                            'Domain transfer',
                            'Branding materials',
                            'Personal email for support',
                            'Help with the migration',
                            'LLC transfer if needed, we cover the cost',
                        ]"
                        :notIncluded="[]"
                        cta="Buy now"
                        :ctaUrl="route('redirect-to-buyout')"
                        :as-form="true"
                    />
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
