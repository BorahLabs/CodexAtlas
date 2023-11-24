@props([
    'name' => false,
    'nameClass' => 'text-2xl font-bold text-white',
    'vertical' => false,
])
@if ($name)
    <div class="flex {{ $vertical ? 'space-y-2 flex-col justify-center' : 'space-x-2 items-center' }}">
        <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" {{ $attributes }} />
        <span class="{{ $nameClass }}">{{ config('app.name') }}</span>
    </div>
@else
    <img src="{{ asset('images/logo.png') }}" alt="{{ config('app.name') }}" {{ $attributes }} />
@endif
