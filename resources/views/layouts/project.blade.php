<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div x-data="{ showOnboarding: {{ !session()->has('provider') && $errors->isEmpty() && $project->repositories->isEmpty() ? 'true' : 'false' }} }">
                @if (auth()->user()->currentTeam->sourceCodeAccounts->isEmpty())
                    <x-codex.onboarding.steps :current="2" x-show="showOnboarding" x-model="showOnboarding" />
                @elseif ($project->repositories->isEmpty())
                    <x-codex.onboarding.steps :current="3" x-show="showOnboarding" x-model="showOnboarding" />
                @endif
                <div x-show="!showOnboarding" x-cloak>
                    <div class="flex flex-wrap">
                        <aside class="flex-shrink-0 mr-8">
                            <nav>
                                <ul class="divide-y divide-[#504A8A]">
                                    <li class="py-2">
                                        <x-codex.projects.nav-link :to="route('projects.show', ['project' => $project])" text="Repositories"
                                            icon="file" />
                                    </li>
                                    <li class="py-2">
                                        <x-codex.projects.nav-link to="route('projects.show', ['project' => $project])"
                                            text="Guides" :disabled="true" icon="list" />
                                    </li>
                                    <li class="py-2">
                                        <x-codex.projects.nav-link to="route('projects.show', ['project' => $project])"
                                            text="External Platforms" :disabled="true" icon="mosaic" />
                                    </li>
                                    <li class="py-2">
                                        <x-codex.projects.nav-link :to="route('glossary.show', ['project' => $project])" text="Glossary"
                                            icon="book" />
                                    </li>
                                    <li class="py-2">
                                        <x-codex.projects.nav-link to="route('projects.show', ['project' => $project])"
                                            text="PRs Assistant" :disabled="true" icon="rocket" />
                                    </li>
                                </ul>
                            </nav>
                        </aside>
                        <div class="min-w-[500px] flex-1">
                            {{ $slot }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
</x-app-layout>
