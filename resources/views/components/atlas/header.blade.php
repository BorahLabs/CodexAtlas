<div class="flex items-center justify-between">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
        {{ $project->name }} &gt; {{ $repository->name }} &gt; {{ $branch->name }}
    </h2>
    <div class="relative flex basis-0 items-center justify-end gap-6 sm:gap-8 md:flex-grow">
        <a href="{{ $repository->url() }}" target="_blank" class="group" aria-label="GitHub">
            <x-dynamic-component :component="$repository->sourceCodeAccount->getProvider()->icon()" class="h-6 w-6 text-slate-400 group-hover:text-slate-500" />
        </a>
    </div>
</div>
