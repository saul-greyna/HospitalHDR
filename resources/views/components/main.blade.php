@props([
    'title' => 'Hospital Dr. Raúl Hernández',
    'description' =>
        'Hospital privado 24 horas, Clínica cerca de ti y centro médico, hospitalización, emergencia y paquetes de maternidad.',
    'image' => asset('image/preview/preview.jpg'),
    'url' => url()->current(),
])

@php
    $metaDescription = Str::limit($description, 160);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Hospital Dr. Raúl Hernández">
    <meta name="description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ $image }}">
    <meta property="og:url" content="{{ $url }}">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $title }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ $image }}">
    <link rel="canonical" href="{{ $url }}" />
    <link rel="icon" type="image/png" href="{{ asset('icons/favicon-96x96.png') }}" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="{{ asset('icons/favicon.svg') }}" />
    <link rel="shortcut icon" href="{{ asset('icons/favicon.ico') }}" />
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('icons/apple-touch-icon.png') }}" />
    <meta name="apple-mobile-web-app-title" content="Hospital Dr. Raúl Hernández" />
    <link rel="manifest" href="{{ asset('icons/site.webmanifest') }}" />
    <title>{{ $title }}</title>
    @vite(['resources/css/app.css', 'resources/js/menu.js'])
</head>

<body class="font-aeonik">
    <x-header></x-header>
    <main role="main" class="px-4">
        {{ $slot }}
    </main>
    <x-footer></x-footer>
    @stack('scripts')
</body>

</html>
