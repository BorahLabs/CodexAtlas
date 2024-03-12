@props(['active'])

@php
    $classes = $active ?? false ? 'block w-full ps-3 pe-4 py-2 border-l-4 border-violet-600 text-start text-base font-medium text-violet-300 bg-violet-900/50 focus:outline-none focus:text-violet-200 focus:bg-violet-900 focus:border-violet-300 transition duration-150 ease-in-out' : 'block w-full ps-3 pe-4 py-2 border-l-4 border-transparent text-start text-base font-medium text-newGray-400 hover:text-newGray-200 hover:bg-newGray-700 hover:border-newGray-600 focus:outline-none focus:text-newGray-200 focus:bg-newGray-700 focus:border-newGray-600 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
