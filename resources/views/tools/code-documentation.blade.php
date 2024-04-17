<x-web-layout>
    <section class="py-8">
        <div class="w-full sm:max-w-2xl mt-6 p-6 mx-auto shadow-md overflow-hidden sm:rounded-lg prose prose-invert">
            <h1 class="text-4xl font-bold text-center">Free {{ $language->name() }} Code Documentation</h1>
            <p class="text-2xl text-center font-medium mt-2">
                No email required. 100% free. Done in 30 seconds.
            </p>
            <p class="text-lg text-center">
                Create code documentation for {{ $language->name() }} with our free AI-based code documentation tool.
                The documentation that we will generate will not look as sophisticated or detailed as our <a
                    href="{{ route('homepage') }}">professional code documentation service</a> &mdash; but it's 100%
                free.
                Upload your code file and our free tool will return a Markdown file with the code documentation.
            </p>
        </div>
        <div class="w-full sm:max-w-4xl mt-6 p-6 mx-auto">
            <x-bordered-black-box class="text-white">
                <livewire:tools.code-documentation :language="$language->name()" />
            </x-bordered-black-box>
        </div>
    </section>
</x-web-layout>
