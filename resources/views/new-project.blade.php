<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-newGray-200 leading-tight">
            {{ __('Projects') }}
        </h2>
    </x-slot>

    <div class="py-4 sm:py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <x-bordered-black-box>
                <h2 class="font-bold text-slate-300">{{ __('Create new project') }}</h2>
                <form action="{{ route('projects.store') }}" method="POST" class="flex flex-col sm:flex-row items-end mt-4">
                    @csrf
                    <div class="w-full">
                        <x-label for="name" value="{{ __('Project name') }}" style="lightweight" class="mb-4 mt-8" />
                        <x-bordered-input id="name" type="text" class="block w-full" name="name" />
                        <x-input-error for="name" class="mt-2" />
                    </div>
                    <div class="flex-shrink-0 ml-8 mt-4 sm:mt-0">
                        <x-button theme="primary" type="submit">{{ __('Create') }}</x-button>
                    </div>
                </form>
            </x-bordered-black-box>
        </div>
    </div>
</x-app-layout>
