<x-web-layout>
    @section('title', 'Fix my code with AI | CodexAtlas')
    <section class="py-8">
        <div class="w-full sm:max-w-2xl mt-6 p-6 mx-auto shadow-md overflow-hidden sm:rounded-lg prose prose-invert">
            <h1 class="text-4xl font-bold text-center">Fix my code with AI</h1>
            <p class="text-2xl text-center font-medium mt-2">
                No email required. 100% free. Done in 30 seconds.
            </p>
            <p class="text-lg text-center">
                Fix your code with our free AI-based code fixing tool. Please, bear in mind that responses are
                AI-generated and they are subject to mistakes.
                Just add your code and an brief error description in these two text areas and our free tool will try to
                fix your code.
            </p>
        </div>
        <div class="w-full sm:max-w-7xl mt-6 p-6 mx-auto">
            <x-bordered-black-box class="text-white">
                <livewire:tools.code-fixer />
            </x-bordered-black-box>
            <x-cta />
        </div>
    </section>
</x-web-layout>
