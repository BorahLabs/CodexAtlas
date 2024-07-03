@unless ($breadcrumbs->isEmpty())
    <nav class="container mx-auto">
        <ol class="py-4 flex flex-wrap text-sm sm:text-xl text-white">
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="group transition duration-300 z-20 self-end">
                        <a href="{{ $breadcrumb->url }}"
                            class="text-secondary-gradient font-bold hover:underline focus:text-blue-900 focus:underline">
                            {{ $breadcrumb->title }}
                        </a>
                        <span
                            class="block max-w-0 group-hover:max-w-full transition-all duration-500 h-0.5 bg-input-gradient"></span>

                    </li>
                @else
                    <li>
                        {{ $breadcrumb->title }}
                    </li>
                @endif

                @unless ($loop->last)
                    <li class="text-gray-500 px-2">
                        /
                    </li>
                @endif
                @endforeach
            </ol>
        </nav>
    @endunless
