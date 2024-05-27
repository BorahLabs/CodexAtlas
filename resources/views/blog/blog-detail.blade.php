<x-web-layout>
    @section('title', $blog->seo_title)
    @section('og_title', $blog->title)
    @section('metadescription', $blog->seo_description)
    {{-- Hacer la og image de tailgraph en el modelo --}}
    @section('og_image', asset('images/enterprise-og.png'))
    <div class="sm:px-6 lg:px-8 py-12">
        <section class="max-w-4xl mx-auto">
            <h2 class="text-5xl font-bold text-left text-white mb-10">{{ $blog->title }}</h2>

            <div class="text-white opacity-55">
                <span>Published {{ $blog->published_at }}</span>
            </div>

            <section>
                <div class="w-full h-96 flex justify-center mx-auto my-10">
                    <img class="w-full h-full object-fill object-center" src="{{ $blog->image_url }}" alt="{{$blog->slug . '-image'}}">
                </div>

                <div class="prose prose-invert">
                    {!! Str::markdown($blog->markdown_content) !!}
                </div>
            </section>
        </section>

        <section class="max-w-7xl mx-auto mt-10 text-xl">
            <div class="grid grid-cols-3 gap-x-4">
                @forelse ($otherBlogs as $otherBlog)
                    <x-atlas.blog-card :blog="$otherBlog"/>

                @empty
                    No more related Blogs
                @endforelse
            </div>
        </section>
    </div>
</x-web-layout>
