<div>
    @if (!empty($blog->transformed_content->toc()))
        <div x-data="{ open: false }" x-cloak class="lg:hidden block" x-on:click.outside="open = !open">
            <button @click="open = !open" class="font-display text-xl font-bold uppercase text-secondary-gradient">
                <span>On this page</h2>
            </button>
            <div x-transition x-show="open" class="text-white" >
                <ul role="list" class="mt-2 text-white bg-white rounded-lg" x-show="open" id="pageNav">
                    @foreach ($blog->transformed_content->toc() as $key => $tocItem)
                        <li class="flex">
                            <a onclick="changeActiveItem($tocItem->id)" @class([
                                'font-display py-2 font-medium text-dark hover:scale-105 transition-all',
                                'pl-6' => $tocItem->priority > 2,
                                'pl-2' => $tocItem->priority <= 2,
                            ])
                                href="#{{ $tocItem->id }}">
                                {{ $tocItem->text }}
                            </a>
                        </li>
                    @endforeach
                </ul>
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
