@props(['disabled' => false])

<div class="border border-violet-600 rounded-[0.75rem]">
    <div class="bg-gradient-to-b from-[#6042ffb3] to-transparent p-px pb-0 w-full flex rounded-[calc(0.75rem_-_1px)]">
        <x-textarea {{ $attributes }} :disabled="$disabled" class="mt-0 rounded-[calc(0.75rem_-_1px)]" />
    </div>
</div>
