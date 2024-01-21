<x-docs-layout :project="$project" :repository="$repository" :branch="$branch" :lastModifiedAt="$customGuide->updated_at">
    <x-atlas.content :title="$customGuide->title" :content="$customGuide->content" />
    <div class="flex justify-end space-x-2 mt-12">
        @can('update', $customGuide)
            <x-button :href="route('docs.guides.edit', [
                'project' => $project,
                'repository' => $repository,
                'branch' => $branch,
                'customGuide' => $customGuide,
            ])">Edit guide</x-button>
        @endcan
        @can('delete', $customGuide)
            <form method="POST"
                action="{{ route('docs.guides.destroy', ['project' => $project, 'repository' => $repository, 'branch' => $branch, 'customGuide' => $customGuide]) }}"
                x-data x-on:submit="confirm('Are you sure? This action cannot be undone') || $event.preventDefault()">
                @csrf
                <x-danger-button type="submit">Delete
                    guide</x-danger-button>
            </form>
        @endcan
    </div>
</x-docs-layout>
