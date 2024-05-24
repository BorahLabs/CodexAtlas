<x-web-layout>
    @section('title', 'Privacy Policy | CodexAtlas')
    <div class="py-8">
        <div class="w-full sm:max-w-2xl mt-6 p-6 mx-auto shadow-md overflow-hidden sm:rounded-lg prose prose-invert">
            {!! $policy !!}
        </div>
    </div>
</x-web-layout>
