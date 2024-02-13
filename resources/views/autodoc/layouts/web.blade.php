<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', 'Automatic Documentation for software projects')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
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
    @vite(['resources/css/app.css'])

    @production
        <script src="https://cdn.usefathom.com/script.js" data-site="GHXJXCLA" defer></script>
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
            </nav>
            <p class="mt-10 text-center text-xs leading-5 text-gray-500">&copy; {{ date('Y') }} Borah Agency. All
                rights reserved.</p>
        </div>
    </footer>


    <script src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js" defer></script>
    @filamentScripts
    @vite(['resources/js/app.js'])

    @production
        <!-- Smartsupp Live Chat script -->
        <script type="text/javascript">
            var _smartsupp = _smartsupp || {};
            _smartsupp.key = '6cc669f28ae9ea9963a7784e657f1fe8f4488f16';
            window.smartsupp || (function(d) {
                var s, c, o = smartsupp = function() {
                    o._.push(arguments)
                };
                o._ = [];
                s = d.getElementsByTagName('script')[0];
                c = d.createElement('script');
                c.type = 'text/javascript';
                c.charset = 'utf-8';
                c.async = true;
                c.src = 'https://www.smartsuppchat.com/loader.js?';
                s.parentNode.insertBefore(c, s);
            })(document);
        </script>
        <noscript> Powered by <a href=“https://www.smartsupp.com” target=“_blank”>Smartsupp</a></noscript>
    @endproduction
</body>

</html>
