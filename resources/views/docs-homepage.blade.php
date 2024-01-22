<x-docs-layout :project="$project" :repository="$repository" :branch="$branch" :lastModifiedAt="$lastModifiedAt">
    @isset($systemComponent)
        <x-atlas.system-component :systemComponent="$systemComponent" />
    @endisset
    @isset($file)
        <x-atlas.content :title="$file->name" :content="$file->contents()" />
    @endisset
</x-docs-layout>
