<div class="overflow-hidden">
    <div class="py-16 sm:px-2 lg:relative lg:px-0 lg:py-20">
        <div
            class="mx-auto grid max-w-2xl grid-cols-1 items-center gap-x-8 gap-y-16 px-4 lg:max-w-8xl lg:px-8 xl:gap-x-16 xl:px-12">
            <div class="relative z-10 text-center">
                <div class="relative">
                    <div class="flex justify-center items-center mb-4">
                        <span
                            class="inline-flex items-center justify-center mt-3 text-sm bg-[#18243a] text-slate-200 mx-auto px-6 py-2 rounded-lg space-x-2">
                            <x-codex.icons.clock class="w-4 h-4" />
                            <span>{{ $branch->name }}</span>
                        </span>
                    </div>
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

                    <div class="flex justify-center mt-8">
                        <a href="{{ route('docs.download', ['project' => $project, 'repository' => $repository, 'branch' => $branch]) }}"
                            class="inline-flex items-center justify-center mt-3 text-sm text-slate-500 mx-auto px-6 py-2 rounded-lg space-x-2 hover:text-slate-400">
                            <x-codex.icons.download class="h-4 w-4" />
                            <span>Download {{ $branch->name }} branch as Markdown</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
