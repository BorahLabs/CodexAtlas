@php
    $id = uniqid();
@endphp
<svg {{ $attributes }} width="22" height="19" viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
        d="M11.9844 19C13.5698 17.8556 15.4903 17.1859 17.5625 17.1859C18.4948 17.1859 19.3953 17.3214 20.2477 17.5739C20.5445 17.6619 20.8635 17.599 21.1095 17.4041C21.3554 17.2092 21.5 16.9048 21.5 16.5817V1.45812C21.5 0.996711 21.2074 0.591466 20.7835 0.465889C19.7585 0.162183 18.6777 0 17.5625 0C15.546 0 13.6461 0.530002 11.9844 1.46406V19Z"
        fill="url(#paint0_linear_{{ $id }})" />
    <path
        d="M10.0156 1.46406C8.35395 0.530002 6.45402 0 4.4375 0C3.32226 0 2.24154 0.162183 1.21647 0.465889C0.792619 0.591466 0.5 0.996711 0.5 1.45812V16.5817C0.5 16.9048 0.644558 17.2092 0.890543 17.4041C1.13653 17.599 1.4555 17.6619 1.75228 17.5739C2.60473 17.3214 3.5052 17.1859 4.4375 17.1859C6.50972 17.1859 8.43023 17.8556 10.0156 19V1.46406Z"
        fill="url(#paint1_linear_{{ $id }})" />
    <defs>
        <linearGradient id="paint0_linear_{{ $id }}" x1="11" y1="0" x2="11" y2="19"
            gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
        <linearGradient id="paint1_linear_{{ $id }}" x1="11" y1="0" x2="11"
            y2="19" gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
    </defs>
</svg>
