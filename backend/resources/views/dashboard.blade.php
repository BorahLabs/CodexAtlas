<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl p-8 sm:rounded-lg">
                <x-codex.project-list :projects="auth()->user()->currentTeam->projects" />
            </div>
        </div>
    </div>
</x-app-layout>
