@props(['disabled' => false, 'wrapperClass' => ''])

<div class="border w-full border-violet-600 rounded-[0.75rem] {{ $wrapperClass }}">
    <div class="bg-gradient-to-b from-[#6042ffb3] to-transparent p-px pb-0 w-full flex rounded-[calc(0.75rem_-_1px)]">
        <x-input {{ $attributes->merge(['class' => 'w-full mt-0 rounded-[calc(0.75rem_-_1px)]']) }} style="transparent"
            :disabled="$disabled" />
    </div>
</div>
