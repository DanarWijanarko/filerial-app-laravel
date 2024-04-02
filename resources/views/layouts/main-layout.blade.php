<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Filerial&nbsp;&nbsp;|&nbsp; @yield('title')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-900 pl-24 pr-4 font-poppins text-gray-50">
    <x-sidebar />
    {{ $slot }}
    <x-footer />
</body>

</html>
