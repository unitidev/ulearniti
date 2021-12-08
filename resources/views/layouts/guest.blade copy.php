<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" id="htmltag" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        {{--<title>{{ $title }}</title>
        <meta name="description" content="{{ $description }}">

        <meta property="og:title" content="{{ $title }}" />
        <meta property="og:description" content="{{ $description }}">
        <meta property="og:url" content="{{ $url }}" />
        <meta property="og:image" content="{{ $image }}" data-rh="true">--}}

        <link rel="shortcut icon" href="/favicon/favicon.ico">
        <link rel="icon" sizes="16x16 32x32 64x64" href="/favicon/favicon.ico">
        <link rel="icon" type="image/png" sizes="196x196" href="/favicon/favicon-192.png">
        <link rel="icon" type="image/png" sizes="160x160" href="/favicon/favicon-160.png">
        <link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96.png">
        <link rel="icon" type="image/png" sizes="64x64" href="/favicon/favicon-64.png">
        <link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16.png">
        <link rel="apple-touch-icon" href="/favicon/favicon-57.png">
        <link rel="apple-touch-icon" sizes="114x114" href="/favicon/favicon-114.png">
        <link rel="apple-touch-icon" sizes="72x72" href="/favicon/favicon-72.png">
        <link rel="apple-touch-icon" sizes="144x144" href="/favicon/favicon-144.png">
        <link rel="apple-touch-icon" sizes="60x60" href="/favicon/favicon-60.png">
        <link rel="apple-touch-icon" sizes="120x120" href="/favicon/favicon-120.png">
        <link rel="apple-touch-icon" sizes="76x76" href="/favicon/favicon-76.png">
        <link rel="apple-touch-icon" sizes="152x152" href="/favicon/favicon-152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="/favicon/favicon-180.png">
        <meta name="msapplication-TileColor" content="#FFFFFF">
        <meta name="msapplication-TileImage" content="/favicon/favicon-144.png">
        <meta name="msapplication-config" content="/favicon/browserconfig.xml">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
        <script type="text/javascript" src="{{ URL::asset('js/fontawesome6.min.js') }}"></script>

    </head>
    <body class="bg-light dark:bg-dark-1">
        <button onclick="document.getElementById('htmltag').classList.toggle('dark')" class="z-20 fixed top-4 right-4 w-10 h-10 rounded-full bg-yellow-500"></button>
        <div class="font-robo text-darker dark:text-light antialiased min-h-screen">
            {{ $slot }}
        </div>
        @livewireScripts
    </body>
    
</html>
