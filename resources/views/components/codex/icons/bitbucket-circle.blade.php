@php
    $id = uniqid();
@endphp
<svg {{ $attributes }} width="71" height="72" viewBox="0 0 71 72" fill="none" xmlns="http://www.w3.org/2000/svg">
    <rect x="0.5" y="0.5" width="70" height="71" rx="35" stroke="url(#paint0_linear_{{ $id }})" />
    <g clip-path="url(#clip0_{{ $id }})">
        <path
            d="M19.6036 20.0001C19.0021 19.9917 18.508 20.4958 18.5 21.1255C18.5 21.1915 18.5036 21.2576 18.5142 21.3227L23.1384 50.7054C23.2575 51.4476 23.868 51.9936 24.5868 51.9992H46.7713C47.3107 52.0066 47.7745 51.5992 47.8607 51.0412L52.4858 21.3292C52.5817 20.7079 52.1783 20.1219 51.5848 20.0215C51.5226 20.0113 51.4595 20.0057 51.3964 20.0066L19.6036 20.0001ZM39.0752 41.2364H31.9941L30.0765 30.7526H40.7902L39.0743 41.2364H39.0752Z"
            fill="url(#paint1_linear_{{ $id }})" />
        <path
            d="M50.9867 30.7382H40.7715L39.0574 41.2136H31.9825L23.6289 51.5923C23.8937 51.8322 24.2314 51.9652 24.5815 51.968H46.7535C47.2929 51.9755 47.7558 51.5681 47.842 51.011L50.9876 30.7373L50.9867 30.7382Z"
            fill="url(#paint2_linear_{{ $id }})" />
    </g>
    <defs>
        <linearGradient id="paint0_linear_{{ $id }}" x1="35.5" y1="-5.30664e-08" x2="37.305"
            y2="89.1084" gradientUnits="userSpaceOnUse">
            <stop offset="0.255" stop-color="#6042FF" />
            <stop offset="1" stop-color="white" stop-opacity="0" />
        </linearGradient>
        <linearGradient id="paint1_linear_{{ $id }}" x1="35.5" y1="20" x2="36.2445"
            y2="59.6051" gradientUnits="userSpaceOnUse">
            <stop offset="0.255" stop-color="#6042FF" />
            <stop offset="1" stop-color="white" stop-opacity="0" />
        </linearGradient>
        <linearGradient id="paint2_linear_{{ $id }}" x1="37.3083" y1="30.7373" x2="37.7156"
            y2="57.0174" gradientUnits="userSpaceOnUse">
            <stop offset="0.255" stop-color="#6042FF" />
            <stop offset="1" stop-color="white" stop-opacity="0" />
        </linearGradient>
        <clipPath id="clip0_{{ $id }}">
            <rect width="34" height="32" fill="white" transform="translate(18.5 20)" />
        </clipPath>
    </defs>
</svg>
