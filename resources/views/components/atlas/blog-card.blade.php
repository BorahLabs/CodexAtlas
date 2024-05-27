<a href="{{ route('blog.detail', $blog) }}">
    <x-bordered-black-box class="text-white hover:scale-105 transition-all duration-500 cursor-pointer">
        <div class="w-full h-2/3">
            <img class="w-full h-full object-cover object-center" src="{{ $blog->image_url }}"
                alt="{{ $blog->slug . '-image' }}">
        </div>
        <h3 class="text-4xl text-primary-gradient mt-4">{{ $blog->title }}</h3>
        <div class="text-gray-300 text-sm">
            {{ $blog->excerpt }}
        </div>
    </x-bordered-black-box>
</a>
