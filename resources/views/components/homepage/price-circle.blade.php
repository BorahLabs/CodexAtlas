<div class="relative">
    <svg {{ $attributes }} width="240" height="240" viewBox="0 0 240 240" fill="none"
        xmlns="http://www.w3.org/2000/svg">
        <path
            d="M240 120C240 186.274 186.274 240 120 240C53.7258 240 0 186.274 0 120C0 53.7258 53.7258 0 120 0C186.274 0 240 53.7258 240 120ZM24 120C24 173.019 66.9807 216 120 216C173.019 216 216 173.019 216 120C216 66.9807 173.019 24 120 24C66.9807 24 24 66.9807 24 120Z"
            fill="url(#paint0_linear_474_1804)" />
        <defs>
            <linearGradient id="paint0_linear_474_1804" x1="120" y1="-1.76888e-07" x2="125.933" y2="297.031"
                gradientUnits="userSpaceOnUse">
                <stop offset="0.255" stop-color="#6042FF" />
                <stop offset="1" stop-color="white" stop-opacity="0" />
            </linearGradient>
        </defs>
    </svg>
    <div class="absolute left-0 top-0 w-full h-full flex items-center justify-center">
        {{ $slot }}
    </div>
</div>
