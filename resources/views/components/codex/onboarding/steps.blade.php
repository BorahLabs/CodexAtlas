@props([
    'current' => 1,
])
<div {{ $attributes }} x-data="{ isOpen: true }" x-modelable="isOpen">
    <div class="bg-gradient-to-b from-[#6042ffb3] to-transparent p-px rounded-xl w-full flex">
        <div class="bg-dark p-6 rounded-xl w-full flex">
            <div class="bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex">
                <div
                    class="bg-[linear-gradient(338deg,_#070A20_39%,_#1B1853_100%)] p-8 rounded-xl text-white w-full relative overflow-hidden">
                    <img src="{{ asset('images/project-card-bg.png') }}" alt=""
                        class="absolute inset-0 w-full object-cover pointer-events-none opacity-30">
                    <div class="max-w-4xl mx-auto relative">
                        <div class="flex space-x-4 justify-center">
                            <x-application-mark class="h-8" />
                            <h2 class="font-bold text-center text-xl mb-8">
                                Welcome to CodexAtlas!
                            </h2>
                        </div>
                        <p>CodexAtlas structures your knowledge in a way that is easy to navigate and search. We group
                            knowledge
                            by
                            <strong>projects, repositories and branches</strong>.
                        </p>
                        <div class="mt-8 space-y-8">
                            <x-codex.onboarding.step :current="$current" :step="1">
                                <p>
                                    To get started, create a project. <strong>Projects</strong> are the top-level
                                    container for your knowledge. You can think of them as a <strong>group of related
                                        repositories</strong>. For example, you can have a project with a repository for
                                    the back-end and another repository for the front-end.
                                </p>
                            </x-codex.onboarding.step>
                            <x-codex.onboarding.step :current="$current" :step="2">
                                <p>
                                    After creating your first project, you can connect your account from GitHub, Gitlab
                                    or Bitbucket. Once connected, you can start adding your repositories.
                                </p>
                            </x-codex.onboarding.step>
                            <x-codex.onboarding.step :current="$current" :step="3">
                                <div>
                                    <p>
                                        After your account is connected, you can start adding your repositories. To do
                                        so, select the account you want to use to retrieve it and then write the full
                                        name of the repository. Once we verify the access, we will automatically add the
                                        following branches if they exist:
                                    </p>
                                    <ul class="flex flex-wrap gap-2 my-4">
                                        <li><x-codex.branch name="main" /></li>
                                        <li><x-codex.branch name="master" /></li>
                                        <li><x-codex.branch name="production" /></li>
                                        <li><x-codex.branch name="prod" /></li>
                                        <li><x-codex.branch name="release" /></li>
                                        <li><x-codex.branch name="dev" /></li>
                                        <li><x-codex.branch name="develop" /></li>
                                        <li><x-codex.branch name="staging" /></li>
                                    </ul>
                                    <p>
                                        And that's it! You can now start adding your knowledge to CodexAtlas. Enjoy!
                                    </p>
                                </div>
                            </x-codex.onboarding.step>
                        </div>
                    </div>
                    <div class="text-center mt-8">
                        @if ($current === 1)
                            <x-button :href="route('projects.new')" x-on:click="isOpen = false">Perfect!</x-button>
                        @else
                            <x-button type="button" x-on:click="isOpen = false">Perfect!</x-button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
