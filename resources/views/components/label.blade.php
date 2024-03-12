@props(['value', 'style' => 'dark'])

<label
    {{ $attributes->merge([
        'class' => match ($style) {
            'dark' => 'block font-medium text-sm text-newGray-300',
            'light' => 'block font-medium text-sm text-newGray-700',
            'lightweight' => 'block font-normal text-sm text-white',
        },
    ]) }}>
    {{ $value ?? $slot }}
</label>
