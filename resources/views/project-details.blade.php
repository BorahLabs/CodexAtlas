<x-project-layout :project="$project">
    <div x-data="{ showAddRepository: true }">
        <header class="flex items-center justify-between">
            <h1 class="text-white text-xl font-bold">{{ $project->name }}</h1>
            @can('create-repository')
                <button type="button" class="border border-violet-500 px-4 py-2 rounded-lg text-white font-medium uppercase"
                    x-on:click="showAddRepository = !showAddRepository;">
                    Add repository
                </button>
            @endcan
        </header>
        @can('create-repository')
            <div class="border border-slate-700 p-4 rounded-md mb-12 mt-8" x-data="{
                sourceCodeAccount: '{{ auth()->user()->currentTeam->sourceCodeAccounts->first()?->id }}',
                shouldShowForm: true
            }" x-transition
                x-show="showAddRepository" x-cloak x-on:source-code-add.window="shouldShowForm = false"
                x-on:source-code-cancel.window="shouldShowForm = true">
                <h2 class="font-bold text-slate-300">{{ __('Add repository') }}</h2>
                <div class="mt-4">
                    <x-codex.source-code-accounts :accounts="auth()->user()->currentTeam->sourceCodeAccounts" x-model="sourceCodeAccount" />
                </div>
                <form action="{{ route('repositories.store', ['project' => $project]) }}" method="POST" class="mt-4"
                    x-show="shouldShowForm">
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
        <x-codex.repository-list :project="$project" />
        <x-codex.free-plan-banner class="mt-12" />
    </div>
</x-project-layout>
