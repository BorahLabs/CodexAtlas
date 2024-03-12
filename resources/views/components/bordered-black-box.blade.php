<div
    {{ $attributes->merge(['class' => 'bg-gradient-to-b from-[#6242ff59] to-transparent p-px rounded-xl w-full flex']) }}>
    <div class="bg-dark p-6 rounded-xl w-full flex">
        <div class="bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex">
            <div class="bg-black p-8 rounded-xl text-white w-full">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
