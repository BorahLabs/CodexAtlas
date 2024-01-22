<x-app-layout>
    <x-slot name="stickyHeader">
        <x-atlas.header :project="$project" :repository="$repository" :branch="$branch" />
    </x-slot>
    <x-atlas.hero :project="$project" :repository="$repository" :branch="$branch" />

    <div class="bg-slate-200">
        <div class="relative mx-auto flex max-w-7xl justify-center sm:px-2 lg:px-8 xl:px-12">
            <div class="hidden lg:relative lg:block lg:flex-none">
                <div
                    class="sticky top-[4.5rem] -ml-0.5 h-[calc(100vh-4.5rem)] w-64 overflow-y-auto overflow-x-hidden py-16 pl-0.5 pr-8 xl:w-72 xl:pr-16">
                    <x-atlas.navigation :branch="$branch" />
                </div>
            </div>
            <div class="min-w-0 max-w-2xl flex-auto px-4 py-16 lg:max-w-none lg:pl-8 lg:pr-0 xl:px-16">
                @if ($lastModifiedAt)
                    <div class="mb-12 flex justify-start">
                        <p
                            class="text-slate-600 text-sm text-right bg-slate-300 px-4 py-2 flex items-center justify-center space-x-2 rounded-md">
                            <x-codex.icons.clock class="h-4 w-4" />
                            <span>Last updated at: {{ $lastModifiedAt->format('d/m/Y H:i') }}</span>
                        </p>
                    </div>
                @endif
                <article>
                    {{ $slot }}
                </article>
            </div>
        </div>
    </div>
</x-app-layout>
