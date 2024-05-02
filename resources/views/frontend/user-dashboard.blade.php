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
<body>
    <div class="bg-gradient-to-b from-blue-50 to-blue-100 w-full font-monte">
        <x-frontend-header />

        <section class="mx-4">
            {{-- <h1 class="text-blue-900 text-2xl font-bold font-serif pl-2 border-b-2 border-blue-900"> Dashboard</h1> --}}
            <div class="flex items-center py-4 overflow-y-auto whitespace-nowrap border-b-2 border-blue-900">
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
            
                {{-- <span class="mx-5 text-gray-500 dark:text-gray-300">
                    /
                </span>
            
                <a href="#" class="text-gray-600 dark:text-gray-200 hover:underline">
                    Profile
                </a>
            
                <span class="mx-5 text-gray-500 dark:text-gray-300">
                    /
                </span>
            
                <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">
                    Settings
                </a> --}}
            </div>
            <div class='text-sm sm:text-lg mt-4'>
                Welcome, {{Auth::user()->name}}
            </div>

        </section>
    
        <section class="overflow-hidden h-screen flex flex-col md:flex-row mx-2 items-center space-y-6 md:space-y-0 md:space-x-6 justify-center">
            <a href="{{route('orders')}}" class="h-40 sm:h-72 w-72 bg-blue-300 rounded-l-md shadow-2xl hover:cursor-pointer relative flex flex-col justify-center items-center">
                <img src="{{asset('my-assets/images/orders.png')}}"  class="w-24 h-24 sm:w-32 sm:h-32 m-2 rounded-md mx-auto"/>
                <span class="text-blue-900 font-serif font-semibold text-xl flex items-center justify-center">Orders</span>
                @if(!empty($orderCount))
                <div class="bg-red-800 w-10 h-10 rounded-full -m-3 top-0 right-0 absolute">
                    <span class="text-white w-full h-full font-bold flex items-center justify-center">{{$orderCount}}</span>
                </div>
                @endif
            </a>

            <a href="{{route('ordersHistory')}}" class="h-40 sm:h-72 w-72 bg-blue-300 rounded-md shadow-2xl flex flex-col justify-center items-center">
                <img src="{{asset('my-assets/images/no-data.png')}}"  class="w-24 h-24 sm:w-32 sm:h-32 m-2 rounded-md mx-auto"/>
                <span class="text-blue-900 font-serif font-semibold text-xl flex items-center justify-center">Order History</span>   
            </a>
            <a href="{{route('profile')}}" class="h-40 sm:h-72 w-72 bg-blue-300 rounded-r-md shadow-2xl flex flex-col justify-center items-center">
                <img src="{{asset('my-assets/images/profile.png')}}"  class="w-24 h-24 sm:w-32 sm:h-32 m-2 rounded-md mx-auto"/>
                <span class="text-blue-900 font-serif font-semibold text-xl flex items-center justify-center">Profile</span>
            </a>
            
        </section>
    </div>


    

   
    

</body>
</html>