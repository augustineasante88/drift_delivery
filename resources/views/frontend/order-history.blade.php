<!DOCTYPE html>
<html lang="en">
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
        @laravelPWA
    </head>
<body class="bg-gradient-to-b from-blue-50 to-blue-100 font-monte">
    <div class="bg-gradient-to-b from-blue-50 to-blue-100">
        <x-frontend-header />

        <section class="mx-4">
            {{-- <h1 class="text-blue-900 text-2xl font-bold font-serif pl-2 border-b-2 border-blue-900"> My Orders History</h1> --}}
			<div class="flex items-center py-4 overflow-y-auto whitespace-nowrap border-b-2 border-blue-900 mb-6 lg:mb-0">
                <a href="{{route('home-index')}}" class="text-gray-600 dark:text-gray-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z" />
                    </svg>
                </a>
            
                <span class="mx-5 text-gray-500 dark:text-gray-300">
                    /
                </span>
            
                <a href="{{route('dashboard')}}" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Dashboard
                </a>
            
                <span class="mx-5 text-gray-500 dark:text-gray-300">
                    /
                </span>
            
                <a href="{{route('ordersHistory')}}" class="text-blue-600 dark:text-gray-200 hover:underline">
                    My Orders History
                </a>
            
                {{-- <span class="mx-5 text-gray-500 dark:text-gray-300">
                    /
                </span>
            
                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">
                    Settings
                </a> --}}
            </div>

        </section>
    
        <section class="overflow-auto h-full flex flex-col md:flex-row mx-4 md:space-x-6 py-6">
            
            <!-- component -->
            <livewire:user.order-history />
            
        </section>
    </div>

	@livewireScripts

</body>
</html>