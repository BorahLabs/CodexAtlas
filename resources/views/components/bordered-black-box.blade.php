@props([
    'single' => false,
    'innerClass' => null,
])

@if ($single)
    <div
        {{ $attributes->merge(['class' => 'bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex relative overflow-hidden']) }}>
        <div class="{{ $innerClass ?? 'bg-black p-8 rounded-xl text-white w-full' }}">
            {{ $slot }}
        </div>
    </div>
@else
    <div
        {{ $attributes->merge(['class' => 'bg-gradient-to-b from-[#6242ff59] to-transparent p-px rounded-xl w-full flex relative overflow-hidden']) }}>
        <div class="bg-dark p-6 rounded-xl w-full flex">
            <div class="bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex">
                <div class="{{ $innerClass ?? 'bg-black p-8 rounded-xl text-white w-full' }}">
                    {{ $slot }}
                </div>
            </div>
        </div>
    </div>
@endif
