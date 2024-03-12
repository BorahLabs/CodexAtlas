<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8" x-data="{ showOnboarding: {{ $projects->isEmpty() ? 'true' : 'false' }} }">
            @if ($projects->isEmpty())
                <x-codex.onboarding.steps :current="1" x-show="showOnboarding" x-model="showOnboarding" />
            @endif
            <div x-show="!showOnboarding" x-cloak>
                <x-codex.project-list :projects="$projects" />
                <x-codex.free-plan-banner class="mt-12" />
            </div>
        </div>
    </div>
</x-app-layout>
