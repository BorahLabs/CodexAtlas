<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', config('app.name'))</title>
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
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/alpinejs@3.13.3/dist/cdn.min.js" defer></script>

    @production
        <script src="https://cdn.usefathom.com/script.js" data-site="FEPWQLXW" defer></script>
    @endproduction
</head>

<body class="antialiased">
    <div class="">
        {{ $slot }}
    </div>

    @filamentScripts
</body>

</html>
