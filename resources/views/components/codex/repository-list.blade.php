<div>
    @if ($project->repositories->isNotEmpty())
        <h2 class="font-bold text-slate-300">{{ __('Repositories') }}</h2>
        <div class="mb-8 grid grid-cols-1 gap-4 mt-4">
            @foreach ($project->repositories as $repository)
                <div class="border border-slate-700 px-4 py-2 font-medium text-slate-300 rounded-md hover:bg-slate-700">
                    {{ $repository->name }}
                    <div>
                        @foreach ($repository->branches as $branch)
                            <a
                                href="{{ $project->team->currentPlatform()->route('docs.show-readme', ['project' => $project, 'repository' => $repository, 'branch' => $branch]) }}"><span
                                    class="text-xs px-2 py-1 bg-violet-500 font-medium rounded">{{ $branch->name }}</span></a>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif
    <div class="border border-slate-700 p-4 rounded-md">
        <h2 class="font-bold text-slate-300">{{ __('Add repository') }}</h2>
        <form action="{{ route('repositories.store', ['project' => $project]) }}" method="POST" class="mt-4"
            x-data="{ sourceCodeAccount: '{{ auth()->user()->currentTeam->sourceCodeAccounts->first()?->id }}' }">
            @csrf
            <input type="hidden" name="source_code_account_id" x-model="sourceCodeAccount" />
            <x-codex.source-code-accounts :accounts="auth()->user()->currentTeam->sourceCodeAccounts" x-model="sourceCodeAccount" />
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
</div>
