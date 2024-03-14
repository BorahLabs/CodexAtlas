@php
    $id = uniqid();
@endphp
<svg width="70" height="65" viewBox="0 0 70 65" fill="none" xmlns="http://www.w3.org/2000/svg" {{ $attributes }}>
    <g clip-path="url(#clip0_{{ $id }})">
        <path
            d="M2.27217 -0.00076784C1.03364 -0.0177707 0.016465 1.00618 0 2.28517C0 2.4193 0.00731777 2.55344 0.0292711 2.68568L9.5497 62.3695C9.79484 63.877 11.0517 64.986 12.5317 64.9973H58.2056C59.316 65.0125 60.271 64.185 60.4485 63.0515L69.9707 2.69891C70.1683 1.43692 69.3377 0.246718 68.1157 0.0426839C67.9876 0.0219026 67.8577 0.0105674 67.7278 0.0124566L2.27217 -0.00076784ZM42.3608 43.1355H27.7819L23.834 21.8403H45.8916L42.3589 43.1355H42.3608Z"
            fill="url(#paint0_linear_{{ $id }})" />
        <path
            d="M66.8835 21.8115H45.8522L42.3232 43.0896H27.7572L10.5586 64.1712C11.1038 64.6586 11.799 64.9288 12.5198 64.9345H58.168C59.2785 64.9496 60.2316 64.1221 60.4091 62.9905L66.8853 21.8096L66.8835 21.8115Z"
            fill="url(#paint1_linear_{{ $id }})" />
    </g>
    <defs>
        <linearGradient id="paint0_linear_{{ $id }}" x1="34.9999" y1="-0.000976563" x2="34.9999"
            y2="64.9976" gradientUnits="userSpaceOnUse">
            <stop x-bind:stop-color="active ? 'white' : '#262870'" />
            <stop offset="0.885" x-bind:stop-color="active ? '#9A88F5' : '#151466'" />
        </linearGradient>
        <linearGradient id="paint1_linear_{{ $id }}" x1="38.722" y1="21.8096" x2="38.722"
            y2="64.9347" gradientUnits="userSpaceOnUse">
            <stop x-bind:stop-color="active ? 'white' : '#262870'" />
            <stop offset="0.885" x-bind:stop-color="active ? '#9A88F5' : '#151466'" />
        </linearGradient>
        <clipPath id="clip0_{{ $id }}">
            <rect width="70" height="65" x-bind:fill="active ? 'white' : '#262870'" />
        </clipPath>
    </defs>
</svg>
