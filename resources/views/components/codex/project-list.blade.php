<div {{ $attributes }}>
    @if ($projects->isNotEmpty())
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 px-4 sm:px-0">
            @foreach ($projects as $project)
                <x-codex.project-item :project="$project" />
            @endforeach
            @can('create-project')
                <x-codex.new-project-item />
            @endcan
        </div>
    @endif
</div>
