@props(['disabled' => false, 'style' => 'dark'])

<textarea {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge([
    'class' => match ($style) {
        'dark'
            => 'border-newGray-700 bg-newGray-900 text-newGray-300 focus:border-violet-600 focus:ring-violet-600 rounded-md shadow-sm',
        'light'
            => 'border-newGray-400 bg-newGray-100 text-newGray-700 focus:border-violet-600 focus:ring-violet-600 rounded-md shadow-sm',
    },
]) !!}>{{ $slot }}</textarea>
