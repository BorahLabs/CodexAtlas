<x-web-layout>
    @section('title', $blog->title)
    @section('og_title', $blog->title)
    @section('metadescription', $blog->seo_description)
    {{-- Hacer la og image de tailgraph en el modelo --}}
    @section('og_image', $blog->getTailGraphUrl())
    <div class="px-4 sm:px-6 lg:px-8 py-12">
        <section class="max-w-4xl mx-auto">
            <h2 class="text-2xl sm:text-5xl font-bold text-left text-white mb-4 sm:mb-10">{{ $blog->title }}</h2>

            <div class="text-white opacity-55">
                <span>{{ __('Published') . ' - ' . Carbon\Carbon::parse($blog->published_at)->format('H:i d/m/Y') }}</span>
            </div>

            <section>
                <div class="w-full h-54 sm:h-96 flex justify-center mx-auto my-10">
                    <img class="w-full h-full object-fill object-center" src="{{ $blog->image_url }}" alt="{{$blog->slug . '-image'}}">
                </div>

                <div class="prose prose-invert">
                    {!! Str::markdown($blog->markdown_content) !!}
                </div>
            </section>
        </section>

        <section class="max-w-7xl mx-auto mt-10 text-xl">
            <div class="w-full text-center mb-4 sm:mb-10">
                <span class="text-2xl sm:text-4xl text-center text-primary-gradient">{{__('Other blogs')}}</span>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-x-4">
                @forelse ($otherBlogs as $otherBlog)
                    <x-codex.blog.blog-card :blog="$otherBlog"/>
                @empty
                    {{__('No more related Blogs')}}
                @endforelse
            </div>
        </section>
    </div>
</x-web-layout>
