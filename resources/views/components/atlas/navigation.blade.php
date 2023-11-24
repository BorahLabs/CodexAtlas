<nav class="text-base lg:text-sm">
    <ul role="list" class="space-y-9">
        @foreach ($sections as $section)
            <li>
                <h2 class="font-display font-medium text-slate-700">
                    {{ $section->name }}
                </h2>
                <ul role="list"
                    class="mt-2 space-y-2 border-l-2 border-slate-100 lg:mt-4 lg:space-y-4 lg:border-slate-300">
                    @foreach ($section->children as $item)
                        @php
                            $selected = str_ends_with($item->url, request()->path());
                        @endphp
                        <li class="relative"
                            @if ($selected) aria-current="page"
                                x-init="() => {
                                    $el.scrollIntoView({ block: 'center' });
                                }" @endif>
                            <a href="{{ $item->url }}" @class([
                                'block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full',
                                'font-semibold text-indigo-500 before:bg-indigo-500' => $selected,
                                'text-slate-500 before:hidden before:bg-slate-300 hover:text-slate-600 hover:before:block' => !$selected,
                            ])>
                                {{ $item->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</nav>
