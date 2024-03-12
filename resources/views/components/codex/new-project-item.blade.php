@php
    $id = uniqid();
@endphp
<div class="relative flex">
    <div class="bg-gradient-to-b from-[#6042ffb3] to-transparent p-px rounded-xl w-full flex">
        <div class="bg-dark p-6 rounded-xl w-full flex">
            <div class="bg-gradient-to-b from-[#6042ff] to-transparent p-px rounded-xl w-full flex">
                <div
                    class="bg-[linear-gradient(338deg,_#070A20_39%,_#1B1853_100%)] p-8 rounded-xl text-white w-full flex items-center justify-center relative overflow-hidden">
                    <img src="{{ asset('images/project-card-bg.png') }}" alt=""
                        class="absolute inset-0 w-full object-cover pointer-events-none">
                    <div class="absolute inset-0" data-particles data-preset="firefly"></div>
                    <div class="relative">
                        <svg class="w-full max-w-[172px]" width="172" height="104" viewBox="0 0 172 104"
                            fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.375" y="0.375" width="171.25" height="103.25" rx="9.625"
                                stroke="url(#paint0_linear_{{ $id }})" stroke-opacity="0.6"
                                stroke-width="0.75" stroke-dasharray="7 7" />
                            <defs>
                                <linearGradient id="paint0_linear_{{ $id }}" x1="86" y1="0"
                                    x2="86" y2="217" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white" />
                                    <stop offset="1" stop-color="white" stop-opacity="0" />
                                </linearGradient>
                                <linearGradient id="paint1_linear_{{ $id }}" x1="86" y1="30.5"
                                    x2="86.2635" y2="89.4988" gradientUnits="userSpaceOnUse">
                                    <stop offset="0.255" stop-color="white" />
                                    <stop offset="1" stop-color="white" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                        </svg>
                        <span
                            class="text-white-gradient text-xl text-center absolute inset-0 flex items-center justify-center p-4">
                            <span>Create new project</span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <a href="{{ route('projects.new') }}" aria-label="Create new project" class="absolute inset-0"></a>
</div>
