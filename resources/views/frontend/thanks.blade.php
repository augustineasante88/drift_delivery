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
        @laravelPWA
    </head>
<body class='bg-gradient-to-b from-blue-50 to-blue-100 overflow-hidden font-monte'>
<x-frontend-header />
<div class="flex items-center justify-center h-full ">
    <div class='mx-8'>
      <div class="flex flex-col items-center text-center space-y-8 md:space-y-4 mb-12">
        <svg xmlns="http://www.w3.org/2000/svg" class="text-green-600 w-28 h-28" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1">
          <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h1 class="text-4xl font-bold">Thank You! Your order has been recieved</h1>
        <p class='text-lg'>Thank you for using drift delivery service! Check your email for order confirmation.</p>
        <a
          class="inline-flex items-center px-4 py-2 text-white bg-blue-900 border border-blue-900 rounded rounded-full hover:bg-indigo-700 focus:outline-none focus:ring">
          
          <span class="text-xl font-medium text-center px-4">
           Refer a friend to use drift delivery service and earn points.
          </span>
        </a>
      </div>
    </div>
  </div>
    @livewireScripts
</body>
</html>