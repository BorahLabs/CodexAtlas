<x-web-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-12">
        <h2 class="text-4xl font-bold text-center text-white mb-10">Blog</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-10 w-full">
            @forelse ($blogs as $key => $blog)
                <x-codex.blog.blog-card :blog="$blog" />
            @empty
                <div class="flex flex-col w-full mx-auto col-span-2 justify-center items-center mt-10">
                    <div class="w-full h-full flex justify-center">
                        <img class="w-96" src="{{ asset('casper-assets/http-code/planet-cropped.png') }}" alt="">
                    </div>
                    <span class="text-3xl mt-4 text-center text-primary-gradient">Nothing to see yet!</span>
                </div>
            @endforelse
        </div>
    </div>
</x-web-layout>
