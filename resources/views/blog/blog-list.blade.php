<x-web-layout>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 py-12">
        <h2 class="text-4xl font-bold text-center text-white mb-10">Blog</h2>

        <div class="grid grid-cols-2 gap-10">
            @php
                $blog = $blogs->first();
            @endphp
            @forelse ($blogs as $key => $blog)
                <x-atlas.blog-card :blog="$blog" />
            @empty
                <div class="text-3xl col-span-2 text-center text-white">
                    No posts available
                </div>
            @endforelse
        </div>
    </div>
</x-web-layout>
