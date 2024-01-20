@props(['value', 'style' => 'dark'])

<label
    {{ $attributes->merge([
        'class' => match ($style) {
            'dark' => 'block font-medium text-sm text-gray-300',
            'light' => 'block font-medium text-sm text-gray-700',
        },
    ]) }}>
    {{ $value ?? $slot }}
</label>
