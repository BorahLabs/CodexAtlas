<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ showOnboarding: {{ auth()->user()->currentTeam->projects->isEmpty()? 'true': 'false' }} }">
            @if (auth()->user()->currentTeam->projects->isEmpty())
                <x-codex.onboarding.steps :current="1" x-show="showOnboarding" x-model="showOnboarding" />
            @endif
            <div x-show="!showOnboarding" x-cloak>
                <div class="bg-gray-800 overflow-hidden shadow-xl p-8 sm:rounded-lg">
                    <x-codex.project-list :projects="auth()->user()->currentTeam->projects" />
                </div>
                <x-codex.free-plan-banner class="mt-12" />
            </div>
        </div>
    </div>
</x-app-layout>
