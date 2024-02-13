<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-newGray-200 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ showOnboarding: {{ !session()->has('provider') && $errors->isEmpty() && $project->repositories->isEmpty() ? 'true' : 'false' }} }">
            @if (auth()->user()->currentTeam->sourceCodeAccounts->isEmpty())
                <x-codex.onboarding.steps :current="2" x-show="showOnboarding" x-model="showOnboarding" />
            @elseif ($project->repositories->isEmpty())
                <x-codex.onboarding.steps :current="3" x-show="showOnboarding" x-model="showOnboarding" />
            @endif
            <div x-show="!showOnboarding" x-cloak>
                <div class="bg-newGray-800 overflow-hidden shadow-xl p-8 sm:rounded-lg">
                    <x-codex.repository-list :project="$project" />
                </div>
                <x-codex.free-plan-banner class="mt-12" />
            </div>
        </div>
    </div>
</x-app-layout>
