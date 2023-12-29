<div>
    @if ($project->repositories->isNotEmpty())
        <h2 class="font-bold text-slate-300">{{ __('Repositories') }}</h2>
        <div class="grid grid-cols-1 gap-4 mt-4">
            @foreach ($project->repositories as $repository)
                <div class="flex border border-slate-700 font-medium text-slate-300 rounded-md">
                    <div class="px-4 py-2">
                        {{ $repository->full_name }}
                        <div>
                            @foreach ($repository->branches as $branch)
                                <a
                                    href="{{ $project->team->currentPlatform()->route('docs.show-readme', ['project' => $project, 'repository' => $repository, 'branch' => $branch]) }}"><x-codex.branch
                                        :name="$branch->name" /></a>
                            @endforeach
                        </div>
                    </div>
                    @if ($repository->branches->isNotEmpty())
                        <div class="ml-auto flex">
                            <a href="{{ $project->team->currentPlatform()->route('docs.show-readme', ['project' => $project, 'repository' => $repository, 'branch' => $repository->branches->first()]) }}"
                                class="px-4 flex items-center justify-center hover:bg-slate-700">
                                <span class="sr-only">Read {{ $repository->branches->first()->name }} branch</span>
                                <svg class="h-6 w-6" fill="none" stroke-width="1.5" stroke="currentColor"
                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z"></path>
                                </svg>
                            </a>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif

    @can('create-repository')
        <div class="border border-slate-700 p-4 rounded-md {{ $project->repositories->isNotEmpty() ? 'mt-8' : '' }}"
            x-data="{ sourceCodeAccount: '{{ auth()->user()->currentTeam->sourceCodeAccounts->first()?->id }}' }">
            <h2 class="font-bold text-slate-300">{{ __('Add repository') }}</h2>
            <div class="mt-4">
                <x-codex.source-code-accounts :accounts="auth()->user()->currentTeam->sourceCodeAccounts" x-model="sourceCodeAccount" />
            </div>
            <form action="{{ route('repositories.store', ['project' => $project]) }}" method="POST" class="mt-4">
                @csrf
                <input type="hidden" name="source_code_account_id" x-model="sourceCodeAccount" />
                @if (auth()->user()->currentTeam->sourceCodeAccounts->isNotEmpty())
                    <div class="flex items-end mt-8">
                        <div class="w-full">
                            <x-label for="name" value="{{ __('Repository name') }}" />
                            <x-input id="name" type="text" class="mt-1 block w-full" name="name"
                                :autofocus="$project->repositories->isEmpty()" placeholder="Account/Repository" />
                            <x-input-error for="name" class="mt-2" />
                        </div>
                        <div class="flex-shrink-0 pb-1 ml-8">
                            <x-button type="submit">{{ __('Add repo') }}</x-button>
                        </div>
                    </div>
                @endif
            </form>
        </div>
    @endcan
</div>
