<div {{ $attributes }}>
    @if ($projects->isNotEmpty())
        <div class="grid grid-cols-1 gap-4">
            @foreach ($projects as $project)
                <a href="{{ route('projects.show', ['project' => $project]) }}"
                    class="border border-slate-700 px-4 py-2 font-medium text-slate-300 rounded-md hover:bg-slate-700">
                    {{ $project->name }}
                </a>
            @endforeach
        </div>
    @endif
    @can('create-project')
        <div class="border border-slate-700 p-4 rounded-md {{ $projects->isNotEmpty() ? 'mt-8' : '' }}">
            <h2 class="font-bold text-slate-300">{{ __('Create new project') }}</h2>
            <form action="{{ route('projects.store') }}" method="POST" class="flex items-end mt-4">
                @csrf
                <div class="w-full">
                    <x-label for="name" value="{{ __('Project name') }}" />
                    <x-input id="name" type="text" class="mt-1 block w-full" name="name" :autofocus="$projects->isEmpty()" />
                    <x-input-error for="name" class="mt-2" />
                </div>
                <div class="flex-shrink-0 pb-1 ml-8">
                    <x-button type="submit">{{ __('Create') }}</x-button>
                </div>
            </form>
        </div>
    @endcan
</div>
