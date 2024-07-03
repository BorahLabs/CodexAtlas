<div>
    <div>
        <header
            class="flex items-center text-secondary-gradient justify-between">
            <h2 class="font-display text-xl font-bold uppercase ">On this page</h2>
        </header>
        <ul role="list" class="mt-4 text-white" x-show="open" id="pageNav">
            @foreach ($blog->transformed_content->toc() as $key => $tocItem)
                <li @class(['flex',
                            'border-secondary-gradient border-l-4' => $loop->first,
                            'border-white border-l-2' => !$loop->first,
                            ])>

                    <a onclick="changeActiveItem($tocItem->id)"
                        @class(['font-display py-4 font-medium hover:scale-105 transition-all ',
                                'active text-secondary-gradient' => $loop->first,
                                'text-white' => !$loop->first,
                                'pl-2', $tocItem->priority > 2,
                                'pl-0', $tocItem->priority < 2])
                         href="#{{ $tocItem->id }}" id="nav-{{ $tocItem->id }}">
                        {{ $tocItem->text }}
                    </a>

                    {{-- @if ($loop->first)
                        <a onclick="changeActiveItem($tocItem->id)" class="font-display py-4 font-medium text-secondary-gradient active"  href="#{{ $tocItem->id }}" id="nav-{{ $tocItem->id }}">
                            {{ $tocItem->text }}
                        </a>
                    @elseif ($tocItem->priority > 2)
                        <a onclick="changeActiveItem($tocItem->id)" class="mt-2 space-y-2 py-4 pl-4 lg:mt-4 lg:space-y-4 text-white lg:border-slate-300" href="#{{ $tocItem->id }}" id="nav-{{ $tocItem->id }}">{{ $tocItem->text }}</a>
                    @else
                        <a onclick="changeActiveItem($tocItem->id)" class="font-display py-4 font-medium text-white"  href="#{{ $tocItem->id }}" id="nav-{{ $tocItem->id }}">
                            {{ $tocItem->text }}
                        </a>
                    @endif --}}
                </li>
            @endforeach
        </ul>
    </div>
</div>
