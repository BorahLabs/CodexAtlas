@props([
    'href' => null,
    'theme' => 'default',
])
@php
    $style = match ($theme) {
        'default'
            => 'inline-flex items-center px-4 py-2 bg-newGray-200 border border-transparent rounded-md font-semibold text-xs text-newGray-800 uppercase tracking-widest hover:bg-white hover:text-newGray-800 focus:bg-white active:bg-newGray-300 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-newGray-800 transition ease-in-out duration-150',
        'primary'
            => 'inline-flex items-center px-4 py-3 bg-violet-600 border border-transparent rounded-xl font-semibold text-xs text-white uppercase tracking-widest hover:bg-white hover:text-violet-700 focus:bg-violet-700 active:bg-violet-500 focus:outline-none focus:ring-2 focus:ring-violet-500 focus:ring-offset-2 focus:ring-offset-violet-700 transition ease-in-out duration-150',
    };
@endphp
@isset($href)
    <a href="{{ $href }}" {{ $attributes->merge(['class' => $style]) }}>
        {{ $slot }}
    </a>
@else
    <button {{ $attributes->merge(['type' => 'submit', 'class' => $style]) }}>
        {{ $slot }}
    </button>
@endisset
