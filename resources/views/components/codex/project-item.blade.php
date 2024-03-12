{{-- <a href="{{ route('projects.show', ['project' => $project]) }}"
    class="border border-slate-700 px-4 py-2 font-medium text-slate-300 rounded-md hover:bg-slate-700">
    {{ $project->name }}
    <span class="block text-xs font-normal text-slate-400">{{ $project->repositories->count() }}
        {{ Str::plural('repository', $project->repositories->count()) }}</span>
</a> --}}
<div class="relative flex">
    <x-bordered-black-box>
        <x-codex.icons.project-badge />
        <h2 class="text-primary-gradient text-center font-medium text-2xl mt-5">{{ $project->name }}</h2>
        <p class="flex items-baseline justify-center text-center space-x-2 uppercase mt-5 text-sm">
            <span>
                {{ $project->repositories->count() }}
                {{ Str::plural('repository', $project->repositories->count()) }}
            </span>
            <svg class="flex-shrink-0" width="14" height="9" viewBox="0 0 14 9" fill="none"
                xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M13.3536 4.85355C13.5488 4.65829 13.5488 4.34171 13.3536 4.14645L10.1716 0.964466C9.97631 0.769204 9.65973 0.769204 9.46447 0.964466C9.2692 1.15973 9.2692 1.47631 9.46447 1.67157L12.2929 4.5L9.46447 7.32843C9.2692 7.52369 9.2692 7.84027 9.46447 8.03553C9.65973 8.2308 9.97631 8.2308 10.1716 8.03553L13.3536 4.85355ZM0 5H13V4H0V5Z"
                    fill="white" />
            </svg>
        </p>
        @if ($project->repositories->isNotEmpty())
            <ul class="w-10/12 mx-auto text-[#9A88F5] list-disc pl-3 text-xs mt-2">
                @foreach ($project->repositories->take(3) as $repository)
                    <li>
                        <p>{{ $repository->name }}</p>
                    </li>
                @endforeach
            </ul>
        @endif
    </x-bordered-black-box>
    <a href="{{ route('projects.show', ['project' => $project]) }}" aria-label="See {{ $project->name }} project"
        class="inset-0 absolute"></a>
</div>
