<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        @wireUiScripts
        {{-- <script src="//unpkg.com/alpinejs" defer></script> --}}
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <style>
            [x-cloak] { display: none !important; }   
        </style>

        
        @livewireStyles
        
    </head>
<body class='bg-gradient-to-b from-blue-50 to-blue-100'>
    <x-notifications position="top-center" />
    <x-dialog z-index="z-50" blur="md" align="center" />
    <x-frontend-header />



    {{ $slot }}

@livewireScripts
</body>
</html>