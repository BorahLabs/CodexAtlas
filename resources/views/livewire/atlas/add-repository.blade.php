<x-bordered-black-box :single="true" x-data="{
    sourceCodeAccount: $wire.entangle('sourceCodeAccount').live,
    shouldShowForm: true
}" x-show="showAddRepository" class="mt-12 mb-16" x-cloak
    x-on:source-code-add.window="shouldShowForm = false" x-on:source-code-cancel.window="shouldShowForm = true">
    <x-codex.source-code-accounts :accounts="auth()->user()->currentTeam->sourceCodeAccounts" x-model="sourceCodeAccount" />
    <form action="{{ route('repositories.store', ['project' => $project]) }}" method="POST" class="mt-4"
        x-show="shouldShowForm">
        @csrf
        <input type="hidden" name="source_code_account_id" x-model="sourceCodeAccount" />
        @if (auth()->user()->currentTeam->sourceCodeAccounts->isNotEmpty())
            <div class="flex items-end mt-8">
                <div class="w-full">
                    <x-label for="name" style="lightweight" value="{{ __('Repository name') }}" class="mb-2" />
                    {{-- @empty($this->accountRepositories) --}}
                    @if (true)
                        <x-bordered-input id="name" type="text" class="block w-full" name="name"
                            :autofocus="$project->repositories->isEmpty()" placeholder="Account/Repository" />
                    @else
                        <div class="border border-violet-600 rounded-[0.75rem]">
                            <div
                                class="bg-gradient-to-b from-[#6042ffb3] to-transparent p-px pb-0 w-full flex rounded-[calc(0.75rem_-_1px)] overflow-hidden">
                                <select name="name"
                                    class="border-transparent bg-[#121826] text-newGray-300 focus:border-transparent focus:ring-0 shadow-none w-full">
                                    <option value="">Select repository</option>
                                    @foreach ($this->accountRepositories as $repository)
                                        <option value="{{ $repository->fullName }}">{{ $repository->fullName }}</option>
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
</x-bordered-black-box>
