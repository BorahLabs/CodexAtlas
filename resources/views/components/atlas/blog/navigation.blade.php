<div>
    @if (!empty($blog->transformed_content->toc()))
        <div x-data="{ open: false }" x-cloak class="lg:hidden block w-full" x-on:click.outside="open = !open">
            <x-bordered-black-box :single='true' innerClass='p-2 bg-black rounded-xl text-white w-full'
                class="text-white h-full w-full hover:scale-105 cursor-pointer">
                <button @click="open = !open"
                    class="font-display w-full rounded-lg flex justify-between text-primary-gradient items-center text-dark text-xl font-light uppercase">
                    <span>On this page</span>
                    <x-icons.arrow class="text-[6042FF]"/>
                </button>
                <div x-collapse x-show="open" class="text-white mt-2">
                    <ul role="list" class="mt-2 text-white rounded-lg" x-show="open" id="pageNav">
                        @foreach ($blog->transformed_content->toc() as $key => $tocItem)
                            <li class="flex">
                                <a onclick="changeActiveItem($tocItem->id)" @class([
                                    'font-display py-2 font-medium text-sm text-white hover:scale-105',
                                    'pl-4' => $tocItem->priority > 2,
                                    'pl-0' => $tocItem->priority <= 2,
                                ])
                                    href="#{{ $tocItem->id }}">
                                    {{ $tocItem->text }}
                                </a>
                            </li>
                            @if (!$loop->last)
                                <div class="h-px bg-primary-gradient w-full"></div>
                            @endif
                        @endforeach
                    </ul>
                </div>
            </x-bordered-black-box>

        </div>

        <div class="lg:block hidden">
            <header class="flex items-center text-secondary-gradient justify-between">
                <h2 class="font-display text-xl font-bold uppercase ">On this page</h2>
            </header>
            <ul role="list" class="mt-4 text-white" x-show="open" id="pageNav">
                @foreach ($blog->transformed_content->toc() as $key => $tocItem)
                    <li @class([
                        'flex',
                        'border-secondary-gradient border-l-4' => $loop->first,
                        'border-white border-l-2' => !$loop->first,
                    ])>

                        <a onclick="changeActiveItem($tocItem->id)" @class([
                            'font-display py-4 font-medium hover:scale-105 transition-all ',
                            'active text-secondary-gradient' => $loop->first,
                            'text-white' => !$loop->first,
                            'pl-8' => $tocItem->priority > 2,
                            'pl-4' => $tocItem->priority <= 2,
                        ])
                            href="#{{ $tocItem->id }}" id="nav-{{ $tocItem->id }}">
                            {{ $tocItem->text }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

    @endif
</div>
