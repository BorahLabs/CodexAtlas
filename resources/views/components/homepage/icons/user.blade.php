@php
    $id = uniqid();
@endphp
<svg {{ $attributes }} width="31" height="40" viewBox="0 0 31 40" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M7.04429 8.57143C7.04429 3.83756 10.83 0 15.5 0C20.17 0 23.9557 3.83756 23.9557 8.57143C23.9557 13.3053 20.17 17.1429 15.5 17.1429C10.83 17.1429 7.04429 13.3053 7.04429 8.57143Z"
        fill="url(#from_{{ $id }})" />
    <path fill-rule="evenodd" clip-rule="evenodd"
        d="M0.000210327 35.4387C0.145536 26.8868 7.02923 20 15.5 20C23.971 20 30.8548 26.8871 30.9998 35.4393C31.0094 36.0065 30.6871 36.5257 30.1785 36.7623C25.7083 38.8415 20.736 40 15.5006 40C10.2647 40 5.29196 38.8413 0.821496 36.7617C0.312894 36.5251 -0.0094279 36.0059 0.000210327 35.4387Z"
        fill="url(#to_{{ $id }})" />
    <defs>
        <linearGradient id="from_{{ $id }}" x1="15.5" y1="0" x2="15.5" y2="40"
            gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
        <linearGradient id="to_{{ $id }}" x1="15.5" y1="0" x2="15.5" y2="40"
            gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
    </defs>
</svg>
