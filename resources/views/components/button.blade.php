@isset($href)
    <a href="{{ $href }}"
        {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-newGray-200 border border-transparent rounded-md font-semibold text-xs text-newGray-800 uppercase tracking-widest hover:bg-white focus:bg-white active:bg-newGray-300 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-newGray-800 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@else
    <button
        {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-newGray-200 border border-transparent rounded-md font-semibold text-xs text-newGray-800 uppercase tracking-widest hover:bg-white focus:bg-white active:bg-newGray-300 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-newGray-800 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@endisset
