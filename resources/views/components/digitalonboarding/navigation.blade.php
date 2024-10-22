@props([
  'previous' => null,
  'next' => null,
])
<div @class([
  'flex mx-auto mt-8',
  'justify-start' => $previous && !$next,
  'justify-end' => !$previous && $next,
  'justify-between' => $previous && $next,
])>
  @if ($previous)
  <x-filament::button color="gray" size="xl" icon="heroicon-m-arrow-left" wire:click="previous">
    {{ $previous }}
  </x-filament::button>
  @endif

  @if ($next)
  <x-filament::button color="primary" size="xl" icon="heroicon-m-arrow-right" iconPosition="after" wire:click="next">
    {{ $next }}
  </x-filament::button>
  @endif
</div>
