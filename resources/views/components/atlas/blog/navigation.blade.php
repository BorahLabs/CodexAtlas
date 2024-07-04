<div>
    @if (!empty($blog->transformed_content->toc()))
        <div x-data="{ open: false }" x-cloak class="lg:hidden block w-full" x-on:click.outside="open = !open">
            <button @click="open = !open"
                class="font-display w-full rounded-lg flex justify-between px-2 items-center bg-secondary-gradient text-dark text-xl font-bold uppercase">
                <span>On this page</span>
                <div>
                    <svg class="h-8 w-8 text-slate-700 transition" fill="none" stroke-width="1.5" stroke="currentColor"
                        viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
                        x-bind:class="{
                            'rotate-180': open,
                        }">
                        <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
                    </svg>
                </div>
            </button>
            <div x-transition x-show="open" class="text-white mt-2">
                <x-bordered-black-box :single='true' innerClass='p-2 bg-black rounded-xl text-white w-full'
                    class="text-white h-full w-full hover:scale-105 transition-all duration-500 cursor-pointer">
                    <ul role="list" class="mt-2 text-white rounded-lg" x-show="open" id="pageNav">
                        @foreach ($blog->transformed_content->toc() as $key => $tocItem)
                            <li class="flex">
                                <a onclick="changeActiveItem($tocItem->id)" @class([
                                    'font-display py-2 font-medium text-white hover:scale-105 transition-all',
                                    'pl-6' => $tocItem->priority > 2,
                                    'pl-2' => $tocItem->priority <= 2,
                                ])
                                    href="#{{ $tocItem->id }}">
                                    {{ $tocItem->text }}
                                </a>
                            </li>
                            @if (!$loop->last)
                                <div class="h-px bg-secondary-gradient w-1/3"></div>
                            @endif
                        @endforeach
                    </ul>
                </x-bordered-black-box>

            </div>
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
