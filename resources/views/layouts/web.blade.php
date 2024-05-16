<!DOCTYPE html>
<html lang="en">

<head>
    <title>@yield('title', config('app.name'))</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,800&display=swap" rel="stylesheet" />

    <meta name="description" content="@yield('metadescription', 'Reduce the time needed to onboard new developers and get back up to 20% of their time to create new features. Eliminate dependency risk with AI documentation.')">

    <!-- Open Graph Meta Tags -->
    <meta property="og:url" content="{{ request()->url() }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('og_title', 'Create code documentation using AI') | {{ config('app.name') }}">
    <meta property="og:description" content="@yield('metadescription', 'Reduce the time needed to onboard new developers and get back up to 20% of their time to create new features. Eliminate dependency risk with AI documentation.')">
    <meta property="og:image" content="@yield('og_image', asset('images/og.png'))">
    <meta property="og:image:width"" content="1200">
    <meta property="og:image:height"" content="630">

    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta property="twitter:domain" content="{{ request()->host() }}">
    <meta property="twitter:url" content="{{ request()->url() }}">
    <meta name="twitter:title" content="@yield('og_title', 'Create code documentation using AI') | {{ config('app.name') }}">
    <meta name="twitter:description" content="@yield('metadescription', 'Reduce the time needed to onboard new developers and get back up to 20% of their time to create new features. Eliminate dependency risk with AI documentation.')">
    <meta name="twitter:image" content="@yield('og_image', asset('images/enterprise-og.png'))">

    <x-partials.favicon />


    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @production
        <script src="https://cdn.usefathom.com/script.js" data-site="FEPWQLXW" defer></script>
    @endproduction
</head>

<body class="antialiased bg-body text-body font-body">
    <div class="">
        {{-- <x-codex.mission-banner /> --}}
        <x-homepage.navbar />
        {{ $slot }}
        <x-homepage.footer />
    </div>

    @livewireScriptConfig
</body>

</html>
