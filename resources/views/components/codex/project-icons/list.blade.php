@php
    $id = uniqid();
@endphp

<svg {{ $attributes }} width="19" height="19" viewBox="0 0 19 19" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path
        d="M0.5 3.35714C0.5 1.77918 1.7592 0.5 3.3125 0.5H15.6875C17.2408 0.5 18.5 1.77918 18.5 3.35714C18.5 4.93509 17.2408 6.21427 15.6875 6.21427H3.3125C1.7592 6.21427 0.5 4.93509 0.5 3.35714Z"
        fill="url(#paint0_linear{{ $id }})" />
    <path
        d="M1.34375 8.59526C0.87776 8.59526 0.5 8.97902 0.5 9.4524C0.5 9.92579 0.87776 10.3095 1.34375 10.3095H17.6562C18.1222 10.3095 18.5 9.92579 18.5 9.4524C18.5 8.97902 18.1222 8.59526 17.6562 8.59526H1.34375Z"
        fill="url(#paint1_linear{{ $id }})" />
    <path
        d="M1.34375 12.6866C0.87776 12.6866 0.5 13.0704 0.5 13.5438C0.5 14.0172 0.87776 14.4009 1.34375 14.4009H17.6562C18.1222 14.4009 18.5 14.0172 18.5 13.5438C18.5 13.0704 18.1222 12.6866 17.6562 12.6866H1.34375Z"
        fill="url(#paint2_linear{{ $id }})" />
    <path
        d="M1.34375 16.7857C0.87776 16.7857 0.5 17.1695 0.5 17.6429C0.5 18.1162 0.87776 18.5 1.34375 18.5H17.6562C18.1222 18.5 18.5 18.1162 18.5 17.6429C18.5 17.1695 18.1222 16.7857 17.6562 16.7857H1.34375Z"
        fill="url(#paint3_linear{{ $id }})" />
    <defs>
        <linearGradient id="paint0_linear{{ $id }}" x1="9.5" y1="0.5" x2="9.5" y2="18.5"
            gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
        <linearGradient id="paint1_linear{{ $id }}" x1="9.5" y1="0.5" x2="9.5"
            y2="18.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
        <linearGradient id="paint2_linear{{ $id }}" x1="9.5" y1="0.5" x2="9.5"
            y2="18.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
        <linearGradient id="paint3_linear{{ $id }}" x1="9.5" y1="0.5" x2="9.5"
            y2="18.5" gradientUnits="userSpaceOnUse">
            <stop stop-color="white" />
            <stop offset="0.885" stop-color="#9A88F5" />
        </linearGradient>
    </defs>
</svg>
