<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ $project->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 overflow-hidden shadow-xl p-8 sm:rounded-lg">
                <x-codex.repository-list :project="$project" />
                <form action="{{ route('projects.generate-docs', ['project' => $project]) }}" method="POST">
                    @csrf
                    <button>Generate docs</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
