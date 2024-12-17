<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Automatic Documentation for software projects')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta property="og:site_name" content="AutomaticDocs">
    <meta property="og:type" content="website">
    <meta property="og:title" content="AutomaticDocs">
    <meta property="og:description"
        content="Save money and use AI to generate the documentation for your project instead of spending your developers' time on it.">
    <meta property="og:url" content="https://automaticdocs.app/">
    <meta property="og:image" content="{{ asset('images/autodoc_og.jpg') }}">
    <meta name="twitter:image" content="{{ asset('images/autodoc_og.jpg') }}">
    <meta name="twitter:card" content="summary">
    <meta name="twitter:title" content="AutomaticDocs">
    <meta name="twitter:description"
        content="Save money and use AI to generate the documentation for your project instead of spending your developers' time on it.">
    <meta name="twitter:url" content="https://automaticdocs.app/">

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />
    @filamentStyles
    <style>
        .triangle {
            width: 0px;
            height: 0px;
            border-style: solid;
            border-width: 8px 8px 0 8px;
            border-color: white transparent transparent transparent;
        }
    </style>
    @livewireStyles
    @vite(['resources/css/app.css'])

    @production
        <script src="https://cdn.usefathom.com/script.js" data-site="GHXJXCLA" defer></script>

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

<body class="antialiased" id="autodoc">
    <div class="">
        {{ $slot }}
    </div>

    <footer class="bg-white">
        <div class="mx-auto max-w-7xl overflow-hidden px-6 py-20 sm:py-24 lg:px-8">
            <nav class="-mb-6 columns-2 sm:flex sm:justify-center sm:space-x-12" aria-label="Footer">
                <div class="pb-6">
                    <a href="{{ url('/') }}" class="text-sm leading-6 text-gray-600 hover:text-gray-900">Automatic
                        Docs</a>
                </div>
                <div class="pb-6">
                    <a href="{{ route('autodoc.terms') }}"
                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Terms and
                        conditions</a>
                </div>
                <div class="pb-6">
                    <a href="{{ route('autodoc.privacy') }}"
                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">Privacy policy</a>
                </div>
                <div class="pb-6">
                    <a href="https://borah.digital/" target="_blank"
                        class="text-sm leading-6 text-gray-600 hover:text-gray-900">MVP Agency</a>
                </div>
            </nav>
            <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; {{ date('Y') }} CodexAtlas, LLC. All
                rights reserved.</p>
        </div>
    </footer>


    @livewire('notifications')
    @livewireScriptConfig
    @filamentScripts
    @vite(['resources/js/app.js'])
</body>

</html>
