<footer class="relative py-12 sm:pt-24 bg-body overflow-hidden">
    <div class="relative container mx-auto px-4">
        <div
            class="absolute top-0 right-0 -mt-96 -mr-52 w-186 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl">
        </div>
        <div class="relative">
            <div class="text-center mb-20">
                <a class="inline-block" href="{{ route('homepage') }}">
                    <x-application-logo class="h-20" :name="true" nameClass="text-4xl font-bold text-white" />
                </a>
            </div>
            <div class="mb-10" x-data="{ show: false }">
                <p class="font-bold text-violet-50 mb-4 uppercase flex items-center justify-start"
                    x-on:click="show = !show">
                    <span>Free Code Documentation Tools</span>
                    <x-codex.icons.chevron-down class="h-4 w-4 transition ml-4" x-bind:class="{ 'rotate-180': show }" />
                </p>
                <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-sm" x-cloak x-show="show">
                    @foreach (\App\Atlas\Guesser::supportedLanguages() as $language)
                        <li>
                            <a href="{{ route('tools.code-documentation', ['language' => Str::slug($language->name())]) }}"
                                class="text-violet-100 hover:underline tracking-tight">
                                {{ $language->name() }} Code Documentation
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-10" x-data="{ show: false }">
                <p class="font-bold text-violet-50 mb-4 uppercase flex items-center justify-start"
                    x-on:click="show = !show">
                    <span>Free Code Conversion Tools</span>
                    <x-codex.icons.chevron-down class="h-4 w-4 transition ml-4" x-bind:class="{ 'rotate-180': show }" />
                </p>
                <ul class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4 text-sm" x-cloak x-show="show">
                    @foreach (\App\CodeConverter\Tools\CodeConverterTool::all() as $tool)
                        <li>
                            <a href="{{ $tool->url() }}" class="text-violet-100 hover:underline tracking-tight">
                                {{ $tool->name() }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="mb-10">
                <a href="{{ route('tools.code-fixer') }}"
                    class="font-bold text-violet-50 mb-4 uppercase flex items-center justify-start">
                    <span>Fix my code with AI</span>
                </a>
            </div>
            <div class="mb-10">
                <a href="{{ route('tools.readme-generator') }}"
                    class="font-bold text-violet-50 mb-4 uppercase flex items-center justify-start">
                    <span>Free README.md Generator</span>
                </a>
            </div>
            <div class="pt-10 border-t border-newGray-800">
                <div class="md:flex items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <span class="text-newGray-600 tracking-tight">© CodexAtlas, LLC. All rights
                            reserved</span>
                    </div>
                    <div><a class="inline-block mr-10 text-white hover:underline tracking-tight"
                            href="{{ route('terms.show') }}">Terms &amp; Conditions</a><a
                            class="inline-block text-white hover:underline tracking-tight"
                            href="{{ route('policy.show') }}">Privacy
                            Policy</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>
