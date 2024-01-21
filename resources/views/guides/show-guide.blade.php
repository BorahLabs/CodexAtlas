<x-docs-layout :project="$project" :repository="$repository" :branch="$branch" :lastModifiedAt="$customGuide->updated_at">
    <div class="flex justify-end">
        @can('update', $customGuide)
            <x-button :href="route('docs.guides.edit', [
                'project' => $project,
                'repository' => $repository,
                'branch' => $branch,
                'customGuide' => $customGuide,
            ])">Edit guide</x-button>
        @endcan
    </div>
    <x-atlas.content :title="$customGuide->title" :content="$customGuide->content" />
</x-docs-layout>
