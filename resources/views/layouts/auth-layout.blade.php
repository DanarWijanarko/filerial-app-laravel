<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Filerial&nbsp;&nbsp;|&nbsp; @yield('title')</title>

    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <style>
        body {
            background-image: url({{ asset('images/neflix.webp') }})
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex min-h-screen items-center justify-center bg-cover bg-no-repeat font-poppins text-white backdrop-brightness-[0.35]">
    {{ $slot }}

    {{-- Alert --}}
    <x-alert />
</body>

</html>
