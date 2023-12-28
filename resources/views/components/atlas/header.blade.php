<div class="flex items-center justify-between" x-data>
    <h2 class="font-semibold text-xl text-gray-200 leading-tight">
        <a
            href="{{ $project->team->currentPlatform()->route('projects.show', ['project' => $project]) }}">{{ $project->name }}</a>
        &gt; <a
            href="{{ $project->team->currentPlatform()->route('projects.show', ['project' => $project]) }}">{{ $repository->name }}</a>
        &gt; <select aria-label="Change branch"
            class="appearance-none bg-transparent border-0 rounded-md text-xl font-semibold" x-ref="branch"
            x-on:change="window.location.href = $event.target.value">
            @foreach ($repository->branches as $repoBranch)
                <option @selected($repoBranch->id === $branch->id)
                    value="{{ $project->team->currentPlatform()->route('docs.show', ['project' => $project, 'repository' => $repository, 'branch' => $repoBranch]) }}"
                    class="text-gray-800">
                    {{ $repoBranch->name }}</option>
            @endforeach
        </select>
    </h2>
    <div class="relative flex basis-0 items-center justify-end gap-6 sm:gap-8 md:flex-grow">
        <div id="docsearch"></div>
        <a href="{{ $repository->url() }}" target="_blank" class="group" aria-label="GitHub">
            <x-dynamic-component :component="$repository->sourceCodeAccount->getProvider()->icon()" class="h-6 w-6 text-slate-400 group-hover:text-slate-500" />
        </a>
    </div>
</div>
