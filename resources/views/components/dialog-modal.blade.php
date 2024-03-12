@props(['id' => null, 'maxWidth' => null])

<x-modal :id="$id" :maxWidth="$maxWidth" {{ $attributes }}>
    <div class="px-6 py-4">
        <div class="text-lg font-medium text-newGray-100">
            {{ $title }}
        </div>

        <div class="mt-4 text-sm text-newGray-400">
            {{ $content }}
        </div>
    </div>

    <div class="flex flex-row justify-end px-6 py-4 bg-newGray-800 text-end">
        {{ $footer }}
    </div>
</x-modal>
