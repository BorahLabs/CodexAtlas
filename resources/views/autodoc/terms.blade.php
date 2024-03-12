<x-autodoc.web-layout>
    <div class="py-8 bg-black">
        <div class="w-full sm:max-w-2xl mt-6 p-6 mx-auto shadow-md overflow-hidden sm:rounded-lg prose prose-invert">
            {!! Str::markdown(File::get(resource_path('markdown/autodoc-terms.md'))) !!}
        </div>
    </div>
</x-autodoc.web-layout>
