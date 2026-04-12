<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('icons/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('icons/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Hospital Dr." />
    <link rel="manifest" href="{{ asset('icons/site.webmanifest') }}" />
    @props(['title' => 'Hospital Dr. Raúl Hernández'])
    <title>{{ $title }}</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/menu.js'])
    @endif
</head>

<body class="font-aeonik">
    <x-header></x-header>
    <main>
        {{ $slot }}
    </main>
    <x-footer></x-footer>
</body>

</html>
