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
    <div class="bg-gradient-to-b from-blue-50 to-blue-100 h-full overflow-hidden">
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
        
            <a href="{{route('profile')}}" class="text-blue-600 dark:text-gray-200 hover:underline">
                My Profile
            </a>
        
            {{-- <span class="mx-5 text-gray-500 dark:text-gray-300">
                /
            </span>
        
            <a href="#" class="text-blue-600 dark:text-blue-400 hover:underline">
                Settings
            </a> --}}
        </div>

    </section>

    
        <section class="overflow-hidden h-full flex flex-col md:flex-row m-4 space-y-6 md:space-y-0 md:space-x-6">
            
            <!-- component -->
        <div class=" p-8 rounded-md w-full flex flex-col md:flex-row justify-between space-y-4 md:space-y-0 md:gap-4">
            <div class=" bg-white w-full md:w-1/2 shadow-md">
              @if(Session::has('success'))
              <div class="bg-green-100 rounded-lg py-5 px-6 m-4 text-base text-green-700 text-center" role="alert">
                phone number updated successfully
              </div>
              @endif
              
                <h1 class="font-serif text-2xl ml-8 text-blue-800 py-2">Update Your Bio.</h1>
                
                <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action='{{route('update_profile', Auth::user()->id)}}'>
                  @csrf
                  @method('PUT')
                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="username">
                        Username
                      </label>
                      <input disabled value="{{Auth::user()->name}}" name='username' class="shadow appearance-none border rounded opacity-40 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="username" type="text" placeholder="Username">
                    </div>
                    <div class="mb-6">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                        Email
                      </label>
                      <input disabled value="{{Auth::user()->email}}" name='email' class="shadow appearance-none border rounded opacity-40 w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" type="email" placeholder="email">
                    </div>
                    <div class="mb-6">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="phone_number">
                        Phone Number
                      </label>
                      <input name='phone_number' value="{{Auth::user()->phone_number}}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="phone_number" type="text" placeholder="phone number">
                      {{-- <span>your current phone number is {{Auth::user()->phone_number}}</span> <br/> --}}
                      @error('phone_number')<span class='text-red-400'>{{$message}}</span>@enderror
                    </div>
                    <div class="flex items-center justify-between">
                      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update
                      </button>
                    </div>
                  </form>


            </div>

            <div class="bg-white w-full md:w-1/2 shadow-md">
              @if(Session::has('warning'))
              <div class="bg-red-100 rounded-lg py-5 px-6 m-4 text-base text-red-700 text-center" role="alert">
                {{Session::get('warning')}}
              </div>
              @endif
              @if(Session::has('info'))
              <div class="bg-green-100 rounded-lg py-5 px-6 m-4 text-base text-green-700 text-center" role="alert">
                password updated successfully
              </div>
              @endif
                <h1 class="font-serif text-2xl ml-8 text-blue-800 py-2">Change Password</h1>
                <form class=" rounded px-8 pt-6 pb-8 mb-4" method="POST" action='{{route('update_password', Auth::user()->id)}}'>
                  @csrf
                  @method('PUT')
                    <div class="mb-4">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="old_password">
                        old password
                      </label>
                      <input name='old_password' value='{{old('old_password')}}' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="old_password" type="password" placeholder="old password">
                      @error('old_password')<span class='text-red-400'>{{$message}}</span>@enderror
                    </div>
                    <div class="mb-6">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="new_password">
                        New Password
                      </label>
                      <input name='password' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="new_password" type="password" placeholder="new password">
                      @error('password')<span class='text-red-400'>{{$message}}</span>@enderror
                    </div>
                    <div class="mb-6">
                      <label class="block text-gray-700 text-sm font-bold mb-2" for="confirm_password">
                        Confirm Password
                      </label>
                      <input name='password_confirmation' class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="confirm_password" type="password" placeholder="confirm password">
                      @error('password_confirmation')<span class='text-red-400'>{{$message}}</span>@enderror
                    </div>
                    <div class="flex items-center justify-between">
                      <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                        Update
                      </button>
                    </div>
                  </form>
            </div>
                        
        </div>
        </section>
    </div>


</body>
</html>