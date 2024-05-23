<x-web-layout>
    @section('title', 'Free Code Fixer | CodexAtlas')
    <section class="py-8">
        <div class="w-full sm:max-w-2xl mt-6 p-6 mx-auto shadow-md overflow-hidden sm:rounded-lg prose prose-invert">
            <h1 class="text-4xl font-bold text-center">Free Code Fixer</h1>
            <p class="text-2xl text-center font-medium mt-2">
                No email required. 100% free. Done in 30 seconds.
            </p>
            <p class="text-lg text-center">
                Fix code for many languages with our free AI-based code fixer tool.
                The code that we will generate will not look as sophisticated or detailed as our <a
                    href="{{ route('homepage') }}">professional code documentation service</a> &mdash; but it's 100%
                free.
                Write your code and error in this two areas and our free tool will return a Markdown file with the code fixed.
            </p>
        </div>
        <div class="w-full sm:max-w-7xl mt-6 p-6 mx-auto">
            <x-bordered-black-box class="text-white">
                <livewire:tools.code-fixer />
            </x-bordered-black-box>
            <div class="relative w-full px-4 mt-24">
                <div
                    class="absolute bottom-0 right-0 w-186 h-186 bg-gradient-to-t from-violet-700 via-darkBlue-900 to-transparent rounded-full filter blur-4xl pointer-events-none">
                </div>
                <div class="relative max-w-lg lg:max-w-none mx-auto">
                    <h2 class="text-4xl font-bold text-center text-white">Frequently Asked Questions</h2>
                    <div class="mt-8">
                        <x-homepage.faq-question
                            question="What is the difference between your free code documentation tool and the paid version?"
                            answer="This free AI tool does its best to generate professional documentation. However, it's missing some context from other related files. The paid version takes into account different files to generate documentation for each use case, apart from the documentation of every file. You have also the possibility of add custom concepts to improve the knowledge of your codebase." />
                        <x-homepage.faq-question
                            question="Do I have to enter my credit card information to use this free code documentation tool?"
                            answer="No. You don't have to enter any personal information to use Codex's free code documentation tool — it's 100% free." />
                        <x-homepage.faq-question question="Is my code stored by CodexAtlas?"
                            answer="No. An encrypted version of your code is stored only while its being processed and it's deleted immediately." />
                        <x-homepage.faq-question question="I want to use it, but I cannot share my code with OpenAI"
                            answer="If you can work with a custom Azure model in your own account, let us know. If not, Codex also works with open source models that can run on-premises, on your own servers, so your data is always yours. Feel free to get in touch with us!" />
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-web-layout>
