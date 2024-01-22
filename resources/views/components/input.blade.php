@props(['disabled' => false, 'style' => 'dark'])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => match ($style) {
        'dark'
            => 'border-gray-700 bg-gray-900 text-gray-300 focus:border-violet-600 focus:ring-violet-600 rounded-md shadow-sm',
        'light'
            => 'border-gray-400 bg-gray-100 text-gray-700 focus:border-violet-600 focus:ring-violet-600 rounded-md shadow-sm',
    },
]) !!}>
