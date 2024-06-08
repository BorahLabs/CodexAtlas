@php
    $selectedSystemComponent = collect($sections)
        ->pluck('children')
        ->flatten(1)
        ->where(fn($item) => str_ends_with($item->url, request()->path()))
        ->first();
@endphp
<div x-data="{ open: {{ $selectedSystemComponent ? 'true' : 'false' }} }">
    <div class="bg-dark z-40 text-4xl transition fixed top-0 left-0 w-full h-full overflow-auto lg:hidden"
        x-bind:class="{
            'pointer-events-none opacity-0 scale-75': !show,
            'opacity-1 scale-100': show
        }"
        x-bind:tabindex="show ? 0 : -1">
        <div class="w-full p-4 h-full">
            <ul role="list" class="space-y-9 mt-4 pb-10" x-show="open">
                @foreach ($sections as $section)
                    <li>
                        <h3 class="font-display lg:font-medium break-words text-white text-sm font-bold">
                            {{ $section->name }}
                        </h3>
                        <ul role="list"
                            class="mt-2 text-sm space-y-2 border-l-2 border-slate-100 lg:mt-4 lg:space-y-4 lg:border-slate-300">
                            @foreach ($section->children as $item)
                                <li class="relative"
                                    @if ($selectedSystemComponent === $item) aria-current="page"
                                    x-init="() => {
                                        $el.scrollIntoView({ block: 'center' });
                                    }" @endif>
                                    <a href="{{ $item->url }}" @class([
                                        'block break-words text-sm w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full',
                                        'font-semibold text-violet-500 before:bg-violet-500' =>
                                            $selectedSystemComponent === $item,
                                        'text-white font-light lg:font-normal before:hidden before:bg-slate-300 hover:text-white hover:before:block' =>
                                            $selectedSystemComponent !== $item,
                                    ])>
                                        {{ $item->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="hidden lg:block" {{ $attributes }}>
        <header x-on:click="open = !open" class="cursor-pointer flex items-center justify-between">
            <h2 class="font-display font-bold uppercase">Reference</h2>
            <svg class="h-4 w-4 text-slate-700 transition" fill="none" stroke-width="1.5" stroke="currentColor"
                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                x-bind:class="{
                    'rotate-180': open,
                }">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
            </svg>
        </header>
        <ul role="list" class="space-y-9 mt-4" x-show="open">
            @foreach ($sections as $section)
                <li>
                    <h3 class="font-display font-medium text-slate-700">
                        {{ $section->name }}
                    </h3>
                    <ul role="list"
                        class="mt-2 space-y-2 border-l-2 border-slate-100 lg:mt-4 lg:space-y-4 lg:border-slate-300">
                        @foreach ($section->children as $item)
                            <li class="relative"
                                @if ($selectedSystemComponent === $item) aria-current="page"
                                x-init="() => {
                                    $el.scrollIntoView({ block: 'center' });
                                }" @endif>
                                <a href="{{ $item->url }}" @class([
                                    'block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full',
                                    'font-semibold text-violet-500 before:bg-violet-500' =>
                                        $selectedSystemComponent === $item,
                                    'text-slate-500 before:hidden before:bg-slate-300 hover:text-slate-600 hover:before:block' =>
                                        $selectedSystemComponent !== $item,
                                ])>
                                    {{ $item->name }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
</div>
