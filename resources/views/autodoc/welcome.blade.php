<x-autodoc.web-layout>
    <section class="py-16 relative bg-black" id="banner">
        <div class="opacity-15 absolute inset-0 bg-cover bg-center"
            style="background-image: url('{{ asset('images/chip.jpeg') }}')"></div>
        <div class="relative container mx-auto px-4">
            <livewire:autodoc.autodoc />
        </div>
    </section>

    <section class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto grid max-w-2xl grid-cols-1 lg:mx-0 lg:max-w-none lg:grid-cols-2">
                <div class="flex flex-col pb-10 sm:pb-16 lg:pb-0 lg:pr-8 xl:pr-20">
                    <figure class="mt-10 flex flex-auto flex-col justify-between">
                        <blockquote class="text-lg leading-8 text-gray-900">
                            <p>“AutomaticDocs has been a game changer for my projects. Just a few minutes and everything
                                is documented!”</p>
                        </blockquote>
                        <figcaption class="mt-10 flex items-center gap-x-6">
                            <div class="text-base">
                                <div class="font-semibold text-gray-900">Raúl López</div>
                                <div class="mt-1 text-gray-500">Freelancer</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
                <div
                    class="flex flex-col border-t border-gray-900/10 pt-10 sm:pt-16 lg:border-l lg:border-t-0 lg:pl-8 lg:pt-0 xl:pl-20">
                    <figure class="mt-10 flex flex-auto flex-col justify-between">
                        <blockquote class="text-lg leading-8 text-gray-900">
                            <p>“I have been without any documentation in my project for years. Now, thanks to
                                AutomaticDocs, I can update it every month with just a few clicks.”</p>
                        </blockquote>
                        <figcaption class="mt-10 flex items-center gap-x-6">
                            <div class="text-base">
                                <div class="font-semibold text-gray-900">David García</div>
                                <div class="mt-1 text-gray-500">Founder of undisclosed app</div>
                            </div>
                        </figcaption>
                    </figure>
                </div>
            </div>
        </div>
    </section>

    <div class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:max-w-none">
                <div class="text-center">
                    <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                        The best way to automatically document your software
                    </h2>
                    <p class="mt-4 text-lg leading-8 text-gray-300">
                        Automatic Docs has been running for a while now, and we have documented many projects worldwide.
                    </p>
                </div>
                <dl class="mt-16 grid grid-cols-1 gap-0.5 overflow-hidden rounded-2xl text-center">
                    <div class="flex flex-col bg-white/5 p-8">
                        <dt class="text-sm font-semibold leading-6 text-gray-300">Documented files</dt>
                        <dd class="order-first text-3xl font-semibold tracking-tight text-white md:text-5xl">
                            {{ number_format(Cache::remember('system-components-count', now()->addMinutes(5), fn() => \App\Models\SystemComponent::count()), 0) }}
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>

    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl lg:text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-600">Save costs with documentation</h2>
                <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Developers don't like to document code
                </p>
                <p class="mt-6 text-lg leading-8 text-gray-600">
                    Yup. It's a bold statement, but it's true. Developers like to create and solve problems.
                    Documenting code and, even more important, keeping it updated is a really difficult task to
                    accomplish. That's why we created AutomaticDocs. We use AI to generate the documentation for
                    your project in minutes.
                </p>
            </div>
            <div class="mx-auto mt-16 max-w-2xl sm:mt-20 lg:mt-24 lg:max-w-none">
                <dl class="grid max-w-xl grid-cols-1 gap-x-8 gap-y-16 lg:max-w-none lg:grid-cols-3">
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <svg class="h-5 w-5 flex-none text-indigo-600" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path d="M12 7.5a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Z"></path>
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M1.5 4.875C1.5 3.839 2.34 3 3.375 3h17.25c1.035 0 1.875.84 1.875 1.875v9.75c0 1.036-.84 1.875-1.875 1.875H3.375A1.875 1.875 0 0 1 1.5 14.625v-9.75ZM8.25 9.75a3.75 3.75 0 1 1 7.5 0 3.75 3.75 0 0 1-7.5 0ZM18.75 9a.75.75 0 0 0-.75.75v.008c0 .414.336.75.75.75h.008a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.75-.75h-.008ZM4.5 9.75A.75.75 0 0 1 5.25 9h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H5.25a.75.75 0 0 1-.75-.75V9.75Z">
                                </path>
                                <path
                                    d="M2.25 18a.75.75 0 0 0 0 1.5c5.4 0 10.63.722 15.6 2.075 1.19.324 2.4-.558 2.4-1.82V18.75a.75.75 0 0 0-.75-.75H2.25Z">
                                </path>
                            </svg>
                            Save costs
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">
                                For a fraction of the price of a developer's time, you can have <strong>your whole
                                    project
                                    documented in a matter of minutes</strong>.<br>Also, by having the project properly
                                documented,
                                new developments and introductions will be faster.
                            </p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <svg class="h-5 w-5 flex-none text-indigo-600" viewBox="0 0 20 20" fill="currentColor"
                                aria-hidden="true">
                                <path fill-rule="evenodd"
                                    d="M10 1a4.5 4.5 0 00-4.5 4.5V9H5a2 2 0 00-2 2v6a2 2 0 002 2h10a2 2 0 002-2v-6a2 2 0 00-2-2h-.5V5.5A4.5 4.5 0 0010 1zm3 8V5.5a3 3 0 10-6 0V9h6z"
                                    clip-rule="evenodd" />
                            </svg>
                            Privacy-focused
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">
                                We only keep your code on our servers <strong>for a few minutes</strong>, while it's
                                being
                                documented. After that, it's <strong>completely deleted</strong>. Keep in mind, however,
                                that OpenAI
                                might keep it in their logs for up to 30 days, but they will <strong>not</strong>
                                use it to traing their models.
                            </p>
                        </dd>
                    </div>
                    <div class="flex flex-col">
                        <dt class="flex items-center gap-x-3 text-base font-semibold leading-7 text-gray-900">
                            <svg class="h-5 w-5 flex-none text-indigo-600" viewBox="0 0 24 24" fill="currentColor"
                                aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd"
                                    d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25ZM12.75 6a.75.75 0 0 0-1.5 0v6c0 .414.336.75.75.75h4.5a.75.75 0 0 0 0-1.5h-3.75V6Z">
                                </path>
                            </svg>
                            Save onboarding time
                        </dt>
                        <dd class="mt-4 flex flex-auto flex-col text-base leading-7 text-gray-600">
                            <p class="flex-auto">
                                Onboarding a new developer on the team is expensive. Thanks to Automatic Docs, you will
                                enjoy of a <strong>faster onboarding process for new developers</strong> since all the
                                code will be documented in natural language, helping them understand what is going on
                                faster.
                            </p>
                        </dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>


    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="grid grid-cols-1 items-center gap-x-8 gap-y-16 lg:grid-cols-2">
                <div class="mx-auto w-full max-w-xl lg:mx-0">
                    <h2 class="text-3xl font-bold tracking-tight text-gray-900">
                        We support your framework
                    </h2>
                    <p class="mt-6 text-lg leading-8 text-gray-600">
                        Automatic Docs is created to support the following frameworks. Don't see yours? Get in touch
                        using the chat button on the bottom right!
                    </p>
                    <div class="mt-8 flex items-center gap-x-6">
                        <a href="#banner"
                            class="fi-btn rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">
                            Document my code
                        </a>
                    </div>
                </div>
                <div
                    class="mx-auto grid w-full max-w-xl grid-cols-2 items-center gap-y-12 sm:gap-y-14 lg:mx-0 lg:max-w-none lg:pl-8">
                    @foreach (\App\Atlas\Guesser::supportedFrameworks() as $framework)
                        @if ($imageUrl = $framework->imageUrl())
                            <img class="max-h-10 w-full object-contain object-left" src="{{ $imageUrl }}"
                                alt="{{ $framework->name() }}" width="105" height="48">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-4xl text-center">
                <h2 class="text-base font-semibold leading-7 text-indigo-400">Pricing</h2>
                <p class="mt-2 text-4xl font-bold tracking-tight text-white sm:text-5xl">Documenting code has never
                    been
                    cheaper</p>
            </div>
            <p class="mx-auto mt-6 max-w-2xl text-center text-lg leading-8 text-gray-300">The price will be based on
                how
                big your project is. Since the AI computation costs are high, we have divided the pricing in 3 sets.</p>
            <div class="isolate mx-auto mt-10 grid max-w-md grid-cols-1 gap-8 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                @php
                    $pricings = [['name' => 'Small', 'price' => 10, 'max_files' => 100], ['name' => 'Mid-sized', 'price' => 40, 'max_files' => 500], ['name' => 'Large', 'price' => 70, 'max_files' => 1000]];
                @endphp
                @foreach ($pricings as $pricing)
                    <div class="rounded-3xl p-8 xl:p-10 ring-1 ring-white/10">
                        <div class="flex items-center justify-between gap-x-4">
                            <h3 class="text-lg font-semibold leading-8 text-white">
                                {{ $pricing['name'] }} projects</h3>
                        </div>
                        <p class="mt-6 flex items-baseline gap-x-1">
                            <span class="text-4xl font-bold tracking-tight text-white">{{ $pricing['price'] }}
                                &euro;</span>
                        </p>
                        <a href="#banner"
                            class="fi-btn mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white">
                            Document my code
                        </a>
                        <ul role="list" class="mt-8 space-y-3 text-sm leading-6 text-gray-300 xl:mt-10">
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                                Up to {{ $pricing['max_files'] }} files
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                                Smart relevant files detection based on framework
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                                Automatic send by email in Markdown format
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-6 w-5 flex-none text-white" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M16.704 4.153a.75.75 0 01.143 1.052l-8 10.5a.75.75 0 01-1.127.075l-4.5-4.5a.75.75 0 011.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 011.05-.143z"
                                        clip-rule="evenodd" />
                                </svg>
                                24-hour support response time
                            </li>
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="bg-gray-900 py-24 sm:py-32">
        <div class="relative isolate">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div
                    class="mx-auto flex max-w-2xl flex-col gap-16 bg-white/5 px-6 py-16 ring-1 ring-white/10 sm:rounded-3xl sm:p-8 lg:mx-0 lg:max-w-none lg:flex-row lg:items-center lg:py-20 xl:gap-x-20 xl:px-20">
                    <div class="w-full flex-auto">
                        <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">
                            Start documenting
                        </h2>
                        <p class="mt-6 text-lg leading-8 text-gray-300">Seriously. Once and for all, it's never been
                            easier!</p>
                        <ul role="list"
                            class="mt-10 grid grid-cols-1 gap-x-8 gap-y-3 text-base leading-7 text-white sm:grid-cols-2 md:grid-cols-3">
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                Less technical debt
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                Faster onboardings
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                Lower costs
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                More dev. time
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                Less bug risk
                            </li>
                            <li class="flex gap-x-3">
                                <svg class="h-7 w-5 flex-none" viewBox="0 0 20 20" fill="currentColor"
                                    aria-hidden="true">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 10-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z"
                                        clip-rule="evenodd" />
                                </svg>
                                Peace of mind
                            </li>
                        </ul>
                        <div class="mt-10 flex">
                            <a href="#banner"
                                class="w-full fi-btn mt-6 block rounded-md py-2 px-3 text-center text-sm font-semibold leading-6 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 bg-white/10 text-white hover:bg-white/20 focus-visible:outline-white">
                                Document your code now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="absolute inset-x-0 -top-16 -z-10 flex transform-gpu justify-center overflow-hidden blur-3xl"
                aria-hidden="true">
                <div class="aspect-[1318/752] w-[82.375rem] flex-none bg-gradient-to-r from-[#80caff] to-[#4f46e5] opacity-25"
                    style="clip-path: polygon(73.6% 51.7%, 91.7% 11.8%, 100% 46.4%, 97.4% 82.2%, 92.5% 84.9%, 75.7% 64%, 55.3% 47.5%, 46.5% 49.4%, 45% 62.9%, 50.3% 87.2%, 21.3% 64.1%, 0.1% 100%, 5.4% 51.1%, 21.4% 63.9%, 58.9% 0.2%, 73.6% 51.7%)">
                </div>
            </div>
        </div>
    </div>
</x-autodoc.web-layout>
