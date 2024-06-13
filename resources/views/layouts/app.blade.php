<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

    <x-partials.favicon />

    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
        <script src="https://cdn.usefathom.com/script.js" data-site="FEPWQLXW" defer></script>
        <script type="text/javascript">
            window.$crisp = [];
            window.CRISP_WEBSITE_ID = "3a93d028-9842-49b4-abb3-c518902f2909";
            (function() {
                d = document;
                s = d.createElement("script");
                s.src = "https://client.crisp.chat/l.js";
                s.async = 1;
                d.getElementsByTagName("head")[0].appendChild(s);
            })
            ();
        </script>
    @endproduction
</head>

<body class="font-sans antialiased bg-dark">
    <x-banner />

    <div class="min-h-screen overflow-hidden">
        <div
            class="w-[941px] h-[941px] flex-shrink-0 rounded-full border-radius: bg-[radial-gradient(50%_50%_at_50%_50%,_rgba(138,_51,_226,_0.52)_0%,_#070C2A_81%)] filter-[blur(75px)] fixed left-[-386px] top-[184px] -z-1">
        </div>
        <div
            class="w-[941px] h-[941px] flex-shrink-0 rounded-full border-radius: bg-[radial-gradient(50%_50%_at_50%_50%,_rgba(138,_51,_226,_0.52)_0%,_#070C2A_81%)] filter-[blur(75px)] fixed left-[calc(100%_-_900px)] top-[calc(100%_-_250px)] -z-1 hidden xl:block">
        </div>
        <div class="relative">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-dark">
                    <div class="max-w-7xl mx-auto pt-20 pb-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            @if (isset($stickyHeader))
                <header class="bg-[#070C2A] z-40 sticky top-0">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $stickyHeader }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScriptConfig
    @livewire('wire-elements-modal')
</body>

</html>
