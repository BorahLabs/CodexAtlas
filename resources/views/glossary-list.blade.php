<x-project-layout :project="$project">
    <div x-data="{ showAddKeyword: true }">
        <header class="flex items-center justify-between">
            <h1 class="text-white text-xl font-bold">Tell us a little about your project</h1>
        </header>

        <div class="mt-10">
            <p class="text-white">
                While artificial intelligence can be great at understanding your code in many ways, there are still areas that need human expertise and knowledge. Could you work with us to address these needs?
                If your project involves specific terms or concepts, please feel free to provide them so that we can customise our documentation and provide you with the best possible service.
            </p>

            <div class="mt-16">
                <div class="flex justify-between items-center mb-16">
                    <h2 class="text-white">Repositories</h2>

                    <button type="button"
                        class="border border-violet-500 px-4 py-2 rounded-lg text-white font-medium uppercase flex items-center justify-between space-x-2"
                        x-on:click="showAddKeyword = !showAddKeyword;">
                        <svg width="23" height="23" viewBox="0 0 23 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M20.8218 10.1678H12.8306V2.17659C12.8306 1.82336 12.6902 1.4846 12.4405 1.23482C12.1907 0.985048 11.8519 0.844727 11.4987 0.844727C11.1455 0.844727 10.8067 0.985048 10.5569 1.23482C10.3072 1.4846 10.1668 1.82336 10.1668 2.17659V10.1678H2.17562C1.82238 10.1678 1.48362 10.3081 1.23385 10.5579C0.984072 10.8077 0.84375 11.1464 0.84375 11.4997C0.84375 11.8529 0.984072 12.1917 1.23385 12.4414C1.48362 12.6912 1.82238 12.8315 2.17562 12.8315H10.1668V20.8228C10.1668 21.176 10.3072 21.5148 10.5569 21.7645C10.8067 22.0143 11.1455 22.1546 11.4987 22.1546C11.8519 22.1546 12.1907 22.0143 12.4405 21.7645C12.6902 21.5148 12.8306 21.176 12.8306 20.8228V12.8315H20.8218C21.175 12.8315 21.5138 12.6912 21.7635 12.4414C22.0133 12.1917 22.1536 11.8529 22.1536 11.4997C22.1536 11.1464 22.0133 10.8077 21.7635 10.5579C21.5138 10.3081 21.175 10.1678 20.8218 10.1678Z"
                                fill="url(#paint0_linear_302_4131)" />
                            <defs>
                                <linearGradient id="paint0_linear_302_4131" x1="11.4987" y1="0.844727" x2="11.4987"
                                    y2="22.1546" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" />
                                    <stop offset="0.885" stop-color="#9A88F5" />
                                </linearGradient>
                            </defs>
                        </svg>

                        <span class="uppercase">Add Keyword content</span>
                    </button>
                </div>

                <div class="flex flex-col space-y-4">

                    <div class="bg-fantastic bg-red-500 w-full rounded-lg text-white p-px">
                        <div class="bg-fantastic2 bg-green-500 rounded-lg p-px">
                            <div class="p-3 bg-body rounded-lg">
                                <span class="font-bold">Lorem ipsum:</span>
                                <span>
                                    dolor sit amet consectetur. Ut eget sit blandit aenean ultrices amet eu. Velit cursus tortor lorem.
                                </span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <x-bordered-black-box :single="true" x-data="{
                    sourceCodeAccount: '{{ auth()->user()->currentTeam->sourceCodeAccounts->first()?->id }}',
                    shouldShowForm: true
                }" class="mt-12 mb-16" x-cloak
                    x-show="showAddKeyword" x-on:source-code-add.window="shouldShowForm = false"
                    x-on:source-code-cancel.window="shouldShowForm = true">
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
                                    <x-bordered-input id="name" type="text" class="block w-full" name="name"
                                        :autofocus="$project->repositories->isEmpty()" placeholder="Account/Repository" />
                                    <x-input-error for="name" class="mt-2" />
                                </div>
                                <div class="flex-shrink-0 pb-1 ml-8">
                                    <x-button theme="primary" type="submit">{{ __('Add repo') }}</x-button>
                                </div>
                            </div>
                        @endif
                    </form>
                </x-bordered-black-box> --}}
            </div>
        </div>
    </div>
</x-project-layout>
