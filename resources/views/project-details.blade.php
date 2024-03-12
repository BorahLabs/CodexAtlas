<x-project-layout :project="$project">
    <div>
        <div class="bg-newGray-800 overflow-hidden shadow-xl p-8 sm:rounded-lg">
            <x-codex.repository-list :project="$project" />
        </div>
        <x-codex.free-plan-banner class="mt-12" />
    </div>
</x-project-layout>
