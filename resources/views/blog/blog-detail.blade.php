<x-web-layout>
    @section('title', $blog->seo_title)
    @section('og_title', $blog->seo_title)
    @section('metadescription', $blog->seo_description)
    {{-- Hacer la og image de tailgraph en el modelo --}}
    @section('og_image', $blog->getTailGraphUrl())
    <div class="px-4 sm:px-6 lg:px-8 py-12">
        <section class="max-w-4xl mx-auto">
            <h2 class="text-2xl sm:text-5xl font-bold text-left text-white mb-4 sm:mb-10">{{ $blog->title }}</h2>

            <section>
                <div class="relative aspect-video rounded-xl overflow-hidden mx-auto my-10">
                    <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt }}"
                        class="absolute left-0 top-0 w-full h-full object-cover" />
                    <span
                        class="absolute top-4 right-4 bg-violet-500 text-white text-sm font-medium rounded-md px-2 py-1">{{ $blog->published_at->format('d-m-Y') }}</span>
                </div>

                <div class="prose prose-invert">
                    {!! Str::markdown($blog->markdown_content) !!}
                </div>
                <div class="mt-8 text-white w-full">
                    <livewire:tools.user-feedback :model="$blog" />
                </div>
            </section>
        </section>

        @if ($otherBlogs->count() > 0)
            <section class="max-w-7xl mx-auto mt-10 text-xl">
                <div class="w-full text-center mb-4 sm:mb-10">
                    <span class="text-2xl sm:text-4xl text-center text-secondary-gradient font-bold">{{ __('Other blogs') }}</span>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4">
                    @foreach ($otherBlogs as $otherBlog)
                        <x-codex.blog.blog-card :blog="$otherBlog" />
                    @endforeach
                </div>
            </section>
        @endif
    </div>
</x-web-layout>
