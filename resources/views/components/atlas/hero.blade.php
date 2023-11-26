<div class="overflow-hidden">
    <div class="py-16 sm:px-2 lg:relative lg:px-0 lg:py-20">
        <div
            class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 lg:max-w-8xl lg:px-8 xl:gap-x-16 xl:px-12">
            <div class="relative z-10 text-center">
                <div class="relative">
                    <p
                        class="inline bg-gradient-to-r from-violet-200 to-violet-400 bg-clip-text font-bold font-display text-5xl tracking-tight text-transparent">
                        {{ $repository->name }}
                    </p>
                    <div class="mt-3 text-2xl tracking-tight text-slate-400">
                        {{ $repository->description ?? $project->description }}
                    </div>
                    <div class="mt-8 flex gap-4 justify-center">
                        <x-button
                            href="{{ route('docs.show-readme', ['project' => $project, 'repository' => $repository, 'branch' => $branch]) }}">Get
                            started</x-button>
                        <x-button href="{{ $repository->url() }}" variant="secondary" target="_blank">
                            View on {{ $repository->sourceCodeAccount->getProvider()->name() }}
                        </x-button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
