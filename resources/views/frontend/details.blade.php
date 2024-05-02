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
<body class='font-monte'>
    <x-notifications />

<livewire:user.center-details :center='$center' :categories='$categories'/>
    

   
{{-- <script src="{{asset('my-assets/owl/jQuery.js')}}" type="text/javascript"></script>
<script type="text/javascript" src="{{asset('my-assets/owl/owl.carousel.min.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function(){
  $(".owl-carousel").owlCarousel({
    stagePadding: 50,
    loop:true,
    margin:10,
    nav:false,
    dots:true,
    responsive:{
        0:{
            items:1
        },

        600:{
            items:2
        },
        1000:{
            items:3
        },
        1200:{
            items:4
        }
    }
  });
})
</script> --}}
@livewireScripts
<x-frontend-footer />
</body>
</html>