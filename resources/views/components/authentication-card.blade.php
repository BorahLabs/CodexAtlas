<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-body">
    <img class="absolute bottom-0 left-0 w-full pointer-events-none -z-1"
        src="{{ asset('casper-assets/headers/bg-bottom-lines.png') }}" alt="">
    <div class="relative">
        {{ $logo }}
    </div>

    <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-body overflow-hidden sm:rounded-lg relative">
        {{ $slot }}
    </div>
</div>
