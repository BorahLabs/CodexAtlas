<div>
    @if ($project->repositories->isNotEmpty())
        <h2 class="font-bold text-slate-300">{{ __('Repositories') }}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-4">
            @foreach ($project->repositories as $repository)
                <x-bordered-black-box :single="true">
                    <x-dynamic-component :component="$repository->sourceCodeAccount->getProvider()->circledIcon()" class="h-16 w-16 mx-auto" />
                    <h2 class="font-bold text-xl text-primary-gradient text-center mt-4">
                        <a
                            href="{{ $repository->branches->isNotEmpty() ? route('docs.show', ['project' => $project, 'repository' => $repository, 'branch' => $repository->branches->first()]) : 'javascript:void(0)' }}">
                            {{ $repository->full_name }}
                        </a>
                    </h2>
                    @if ($repository->branches->isNotEmpty())
                        <p class="flex items-baseline justify-center text-center space-x-2 uppercase mt-5 text-sm">
                            <span>
                                {{ $repository->branches->count() }}
                                {{ Str::plural('branch', $repository->branches->count()) }}
                            </span>
                            <svg class="flex-shrink-0" width="14" height="9" viewBox="0 0 14 9" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M13.3536 4.85355C13.5488 4.65829 13.5488 4.34171 13.3536 4.14645L10.1716 0.964466C9.97631 0.769204 9.65973 0.769204 9.46447 0.964466C9.2692 1.15973 9.2692 1.47631 9.46447 1.67157L12.2929 4.5L9.46447 7.32843C9.2692 7.52369 9.2692 7.84027 9.46447 8.03553C9.65973 8.2308 9.97631 8.2308 10.1716 8.03553L13.3536 4.85355ZM0 5H13V4H0V5Z"
                                    fill="white" />
                            </svg>
                        </p>
                        <ul class="w-7/12 mx-auto text-[#9A88F5] list-disc pl-3 text-xs mt-2">
                            @foreach ($repository->branches as $branch)
                                <li>
                                    <a href="{{ route('docs.show', ['project' => $project, 'repository' => $repository, 'branch' => $branch]) }}"
                                        class="hover:underline block">
                                        {{ $branch->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </x-bordered-black-box>
            @endforeach
        </div>
    @endif
</div>
