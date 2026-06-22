<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    class="[&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="[&::-webkit-scrollbar]:hidden [-ms-overflow-style:none] [scrollbar-width:none]">
    <x-top-loading-bar />

    <main>
        {{ $slot }}
    </main>

    @stack('scripts')
</body>

</html>
