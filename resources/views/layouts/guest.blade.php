<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Modak&display=swap" rel="stylesheet">

    <x-partials.favicon />

    @filamentStyles
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .modak {
            font-family: 'Modak', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            font-weight: 400 !important;
            letter-spacing: 0.05em !important;
        }
    </style>
</head>

<body>
    <div class="font-sans text-newGray-100 antialiased">
        {{ $slot }}
    </div>

    @filamentScripts
    @livewireScriptConfig
    @livewire('wire-elements-modal')
</body>

</html>
