<x-bordered-black-box :single="true">
    <div x-data="{
        sourceCodeAccount: $wire.entangle('sourceCodeAccount').live,
        shouldShowForm: true }"
        x-show="showAddRepository" class="mt-12 mb-16" x-cloak
        x-on:source-code-add.window="shouldShowForm = false" x-on:source-code-cancel.window="shouldShowForm = true">
        <x-codex.source-code-accounts :accounts="auth()->user()->currentTeam->sourceCodeAccounts" x-model="sourceCodeAccount" />
        <form action="{{ route('repositories.store', ['project' => $project]) }}" method="POST" class="mt-4"
            x-show="shouldShowForm">
            @csrf
            <input type="hidden" name="source_code_account_id" x-model="sourceCodeAccount" />
            @if (auth()->user()->currentTeam->sourceCodeAccounts->isNotEmpty())
                <div class="flex items-end mt-8">
                    <div class="w-full">
                        <x-label for="name" style="lightweight" value="{{ __('Repository name') }}"
                            class="mb-2" />
                        {{-- @empty($this->accountRepositories) --}}
                        @if (true)
                            @if ($account->provider == App\Enums\SourceCodeProvider::Bitbucket)
                                <div class="flex items-center space-x-2 w-full">
                                    <x-bordered-input id="bitbucket_workspace" list="bitbucket-account-workspace-list"
                                        type="text" wire:model.live.debounce.200ms="bitbucketWorkspace"
                                        class="block w-full" name="bitbucket_workspace" :autofocus="$project->repositories->isEmpty()"
                                        placeholder="Workspace" />

                                    <datalist id="bitbucket-account-workspace-list">
                                        @foreach ($bitbucketWorkspaces as $workspace)
                                            <option value="{{ $workspace }}">{{ $workspace }}</option>
                                        @endforeach
                                    </datalist>

                                    <x-bordered-input id="bitbucket_repo" list="bitbucket-account-repository-list"
                                        type="text" wire:model.live.debounce.200ms="bitbucketRepository"
                                        class="block w-full" name="bitbucket_repo" :autofocus="$project->repositories->isEmpty()"
                                        placeholder="Repository" />

                                    <datalist id="bitbucket-account-repository-list">
                                        @foreach ($bitbucketRepositories as $repo)
                                            <option value="{{ $repo->name }}">{{ $repo->name }}</option>
                                        @endforeach
                                    </datalist>
                                </div>
                            @else
                                <x-bordered-input id="name" list="account-repository-list" type="text"
                                    wire:model.live.debounce.200ms="search" class="block w-full" name="name"
                                    :autofocus="$project->repositories->isEmpty()" placeholder="Account/Repository" />

                                <datalist id="account-repository-list">
                                    @foreach ($repositories as $repo)
                                        <option value="{{ $repo->fullName }}">{{ $repo->fullName }}</option>
                                    @endforeach
                                </datalist>
                            @endif
                        @else
                            <div class="border border-violet-600 rounded-[0.75rem]">
                                <div
                                    class="bg-gradient-to-b from-[#6042ffb3] to-transparent p-px pb-0 w-full flex rounded-[calc(0.75rem_-_1px)] overflow-hidden">
                                    <select name="name"
                                        class="border-transparent bg-[#121826] text-newGray-300 focus:border-transparent focus:ring-0 shadow-none w-full">
                                        <option value="">Select repository</option>
                                        @foreach ($this->accountRepositories as $repository)
                                            <option value="{{ $repository->fullName }}">{{ $repository->fullName }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        @endif
                        <x-input-error for="name" class="mt-2" />
                    </div>
                    <div class="flex-shrink-0 pb-1 ml-8">
                        <x-button theme="primary" type="submit">{{ __('Add repo') }}</x-button>
                    </div>
                </div>
            @endif
        </form>
    </div>
</x-bordered-black-box>
