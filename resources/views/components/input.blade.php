@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' =>
        'border-gray-700 bg-gray-900 text-gray-300 focus:border-violet-600 focus:ring-violet-600 rounded-md shadow-sm',
]) !!}>
