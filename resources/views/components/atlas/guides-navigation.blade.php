<div x-data="{ open: true }" {{ $attributes }}>
    <header x-on:click="open = !open" class="cursor-pointer flex items-center justify-between">
        <h2 class="font-display font-bold uppercase">Guides</h2>
        <svg class="h-4 w-4 text-slate-700 transition" fill="none" stroke-width="1.5" stroke="currentColor"
            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true"
            x-bind:class="{
                'rotate-180': open,
            }">
            <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"></path>
        </svg>
    </header>
    <ul role="list" class="space-y-9 mt-4" x-show="open">
        <li>
            <ul role="list"
                class="mt-2 space-y-2 border-l-2 border-slate-100 lg:mt-4 lg:space-y-4 lg:border-slate-300">
                @can('create', \App\Models\CustomGuide::class)
                    @php
                        $selected = request()->routeIs('docs.guides.new');
                    @endphp
                    <li class="relative"
                        @if ($selected) aria-current="page"
                    x-init="() => {
                        $el.scrollIntoView({ block: 'center' });
                    }" @endif>
                        <a href="{{ route('docs.guides.new', ['branch' => $branch, 'repository' => $branch->repository, 'project' => $branch->repository->project]) }}"
                            @class([
                                'block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full',
                                'font-semibold text-violet-500 before:bg-violet-500' => $selected,
                                'text-slate-500 before:hidden before:bg-slate-300 hover:text-slate-600 hover:before:block' => !$selected,
                            ])>
                            New guide
                        </a>
                    </li>
                @endcan
                @foreach ($branch->customGuides as $customGuide)
                    @php
                        $selected = request()->route('customGuide')?->id === $customGuide->id;
                    @endphp
                    <li class="relative"
                        @if ($selected) aria-current="page"
                            x-init="() => {
                                $el.scrollIntoView({ block: 'center' });
                            }" @endif>
                        <a href="{{ route('docs.guides.show', ['branch' => $branch, 'repository' => $branch->repository, 'project' => $branch->repository->project, 'customGuide' => $customGuide]) }}"
                            @class([
                                'block w-full pl-3.5 before:pointer-events-none before:absolute before:-left-1 before:top-1/2 before:h-1.5 before:w-1.5 before:-translate-y-1/2 before:rounded-full',
                                'font-semibold text-violet-500 before:bg-violet-500' => $selected,
                                'text-slate-500 before:hidden before:bg-slate-300 hover:text-slate-600 hover:before:block' => !$selected,
                            ])>
                            {{ $customGuide->title }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </li>
    </ul>
</div>
