@props(['to', 'text', 'icon', 'disabled' => false])
@php
    $id = uniqid();
    $active = str_ends_with($to, request()->path());
@endphp

<a href="{{ $disabled ? 'javascript:void(0)' : $to }}" @class([
    'min-w-[285px] flex items-center justify-between text-white px-3 py-2 rounded-md text-lg',
    'bg-violet-400' => $active,
    'bg-transparent hover:bg-violet-400 hover:bg-opacity-20' =>
        !$active && !$disabled,
    'cursor-not-allowed bg-transparent' => $disabled,
])>
    <div class="flex justify-start items-center">
        <x-dynamic-component :component="'codex.project-icons.' . $icon" class="flex-shrink-0 mr-2 {{ $active ? 'brightness-0 invert' : '' }}" />
        <span>{{ __($text) }}</span>
    </div>
    @if ($disabled)
        <span class="text-sm bg-violet-200 font-medium text-violet-900 px-2 py-0.5 rounded-lg">Soon</span>
    @else
        <svg class="ml-4 flex-shrink-0" width="21" height="17" viewBox="0 0 21 17" fill="none"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd"
                d="M0.5 8.5C0.5 7.9132 0.979695 7.4375 1.57143 7.4375L16.7685 7.4375L10.8288 1.82839C10.4023 1.42167 10.389 0.749062 10.7991 0.326075C11.2092 -0.0969123 11.8875 -0.110102 12.314 0.296618L20.1712 7.73412C20.3813 7.93444 20.5 8.21098 20.5 8.5C20.5 8.78902 20.3813 9.06556 20.1712 9.26589L12.314 16.7034C11.8875 17.1101 11.2092 17.0969 10.7991 16.6739C10.389 16.2509 10.4023 15.5783 10.8288 15.1716L16.7685 9.5625L1.57143 9.5625C0.979695 9.5625 0.5 9.0868 0.5 8.5Z"
                fill="{{ $active ? 'white' : 'url(#' . $id . ')' }}" fill-opacity="0.7" />
            @if (!$active)
                <defs>
                    <linearGradient id="{{ $id }}" x1="0.5" y1="8.5" x2="20.5" y2="8.5"
                        gradientUnits="userSpaceOnUse">
                        <stop stop-color="white" />
                        <stop offset="0.885" stop-color="#9A88F5" />
                    </linearGradient>
                </defs>
            @endif
        </svg>
    @endif
</a>
