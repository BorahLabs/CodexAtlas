@props(['step', 'current'])
@php
    $opacity = match ($step - $current) {
        0 => 'opacity-100',
        2 => 'opacity-10',
        default => 'opacity-25',
    };
@endphp
<div class="flex space-x-4 {{ $opacity }}">
    <div
        class="h-12 w-12 flex items-center justify-center text-2xl font-bold rounded-full flex-shrink-0 border border-slate-700">
        @if ($step >= $current)
            {{ $step }}
        @else
            <x-codex.icons.check class="h-6 w-6" />
        @endif
    </div>
    {{ $slot }}
</div>
