@props(['question', 'answer'])
<div class="group block w-full text-left border-b-2 border-white border-opacity-10" x-data="{ open: false }">
    <button class="px-4 flex items-start justify-between w-full text-left hover:bg-white/10 py-6"
        x-on:click="open = !open">
        <div class="text-xl text-white tracking-tight font-medium"
            x-bind:class="{
                'text-violet-500': open
            }">
            {{ $question }}</div>
        <span class="inline-block transform text-white"
            x-bind:class="{
                'rotate-180 text-violet-500': open
            }">
            <svg width="24" height="24" viewbox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M12.71 15.54L18.36 9.87998C18.4537 9.78702 18.5281 9.67642 18.5789 9.55456C18.6296 9.4327 18.6558 9.30199 18.6558 9.16998C18.6558 9.03797 18.6296 8.90726 18.5789 8.78541C18.5281 8.66355 18.4537 8.55294 18.36 8.45998C18.1726 8.27373 17.9191 8.16919 17.655 8.16919C17.3908 8.16919 17.1373 8.27373 16.95 8.45998L11.95 13.41L6.99996 8.45998C6.8126 8.27373 6.55915 8.16919 6.29496 8.16919C6.03078 8.16919 5.77733 8.27373 5.58996 8.45998C5.49548 8.5526 5.42031 8.66304 5.36881 8.78492C5.31731 8.90679 5.29051 9.03767 5.28996 9.16998C5.29051 9.30229 5.31731 9.43317 5.36881 9.55505C5.42031 9.67692 5.49548 9.78737 5.58996 9.87998L11.24 15.54C11.3336 15.6415 11.4473 15.7225 11.5738 15.7779C11.7003 15.8333 11.8369 15.8619 11.975 15.8619C12.1131 15.8619 12.2497 15.8333 12.3762 15.7779C12.5027 15.7225 12.6163 15.6415 12.71 15.54Z"
                    fill="currentColor"></path>
            </svg>
        </span>
    </button>
    <div x-cloak class="p-4" x-show="open" x-transition>
        <p class="w-full mt-2 text-lg tracking-tight text-violet-100">
            {{ $answer }}</p>
    </div>
</div>
