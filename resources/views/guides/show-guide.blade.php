<x-docs-layout :project="$project" :repository="$repository" :branch="$branch" :lastModifiedAt="$customGuide->updated_at">
    <x-atlas.content :title="$customGuide->title" :content="$customGuide->content" />
</x-docs-layout>
