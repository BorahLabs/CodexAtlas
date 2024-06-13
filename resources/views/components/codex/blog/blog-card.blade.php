@props(['tag' => 'h2', 'blog'])
<a href="{{ route('blog.detail', $blog) }}" aria-label="{{ $blog->title }}">
    <x-bordered-black-box :single='true'
        class="text-white h-full w-full hover:scale-105 transition-all duration-500 cursor-pointer">
        <article>
            <div class="relative aspect-video rounded-xl overflow-hidden">
                <img src="{{ $blog->image_url }}" alt="{{ $blog->image_alt }}"
                    class="absolute left-0 top-0 w-full h-full object-cover" />
                <span
                    class="absolute top-4 right-4 bg-violet-500 text-white text-sm font-medium rounded-md px-2 py-1">{{ $blog->published_at->format('d-m-Y') }}</span>
            </div>
            @if ($tag === 'h2')
                <h2 class="text-xl sm:text-2xl text-secondary-gradient font-bold mt-4">{{ $blog->title }}</h2>
            @else
                <h3 class="text-xl sm:text-2xl text-secondary-gradient font-bold mt-4">{{ $blog->title }}</h3>
            @endif
            <div class="text-gray-300 text-sm sm:text-base">
                {{ $blog->excerpt }}
            </div>
        </article>
    </x-bordered-black-box>
</a>
