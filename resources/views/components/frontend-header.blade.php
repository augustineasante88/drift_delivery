<header class="mb-12 lg:mb-0 inset-x-0 top-0 z-10 w-full relative" x-data='{
    cartOpen: false,
    menuOpen: false
} '>
    <div class="px-4 mx-auto sm:px-6 lg:px-8 ">
        <div class="flex items-center justify-between h-16 lg:h-20">
            <div class="flex-shrink-0">
                <a href="/" title="" class="flex font-bold text-blue-900 text-2xl sm:text-3xl">
                    Drift.Delivery
                </a>
            </div>

            <div class='flex space-x-2'>
            <button x-cloak @click="menuOpen = !menuOpen" type="button" class="inline-flex items-center p-2 text-sm text-white uppercase transition-all duration-200 bg-black lg:hidden focus:bg-gray-800 hover:bg-gray-800">
                <!-- Menu open: "hidden", Menu closed: "block" -->
                <svg :class="menuOpen ? 'hidden' : 'block' " class=" w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>

                <!-- Menu open: "block", Menu closed: "hidden" -->
                <svg :class="menuOpen ? 'block' : 'hidden' " class="w-6 h-6 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>

                Menu
            </button>
            <div class='block lg:hidden'>
            <livewire:user.cart-counter />
            </div>
            </div>

            {{-- mobile menu --}}
            <!-- inspiration from UI Design Daily -->
            <div x-cloak x-show="menuOpen"  @click.outside="menuOpen = false" class="w-[325px] sm:w-[460px] md:w-[700px] h-full absolute z-5 mt-32 block lg:hidden"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90"
            >
                <div class="bg-white shadow-lg rounded-xl overflow-hidden" >
                <header class="bg-gradient-to-r from-blue-200 to-blue-400 transform flex items-center mb-5 py-1 px-6">
                </header>

                <ul class="px-8 relative pb-5">
                <div class='group'>
                    <a href="{{route('eatingPlaces')}}" class="{{ request()->routeIs('eatingPlaces') ? 'text-white bg-black focus:text-white' : 'text-black' }} flex px-2 group-hover:bg-black group-hover:text-white group-hover:rounded items-center text-md py-4"><span class="text-gray-400 group-hover:fill-current group-hover:text-white mr-5"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></span> Featured places</a>
                </div>
                @auth
                <div class='group'>
                <a href="{{route('dashboard')}}" class="{{ request()->routeIs('userDashboard') ? 'text-white bg-black focus:text-white' : 'text-black' }} flex px-2 group-hover:bg-black group-hover:text-white group-hover:rounded items-center text-md py-4"><span class="text-gray-400 group-hover:fill-current group-hover:text-white mr-5"><svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17V7m0 10a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h2a2 2 0 012 2m0 10a2 2 0 002 2h2a2 2 0 002-2M9 7a2 2 0 012-2h2a2 2 0 012 2m0 10V7m0 10a2 2 0 002 2h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2"></path></svg></span> Dashboard</a>
                </div>
                @endauth
                
                @if(empty(auth()->check()))
                <div class='group'>
                <a href="{{route('login')}}" class="flex px-2 group-hover:bg-black group-hover:text-white group-hover:rounded items-center text-gray-900 text-md py-4"><span class="text-gray-400 group-hover:fill-current group-hover:text-white mr-5"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 4v12l-4-2-4 2V4M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg></span> Login</a>
                </div>
                <div class='group'>
                <a href="{{route('register')}}" class="flex px-2 group-hover:bg-black group-hover:text-white group-hover:rounded items-center text-gray-900 text-md py-4 "><span class="text-gray-400 group-hover:fill-current group-hover:text-white mr-5"><svg class="w-6 h-6 " fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg></span>Sign Up</a>
                </div>
                
                @endif
                <div class='group'>
                <li class="flex px-2 group-hover:bg-black group-hover:text-white group-hover:rounded items-center text-gray-900 text-md py-4"><span class="text-gray-400 group-hover:fill-current group-hover:text-white mr-5"><svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg></span> Contact Us</li>
                </div>
                @auth
                <div class='group'>
                    <form method="POST" action="{{ route('logout') }}" x-data>
                        @csrf
                <a href="{{route('logout')}}" @click.prevent="$root.submit();"  class="flex px-2 group-hover:bg-black group-hover:text-white group-hover:rounded items-center text-gray-900 text-md py-4"><span class="text-gray-400 group-hover:fill-current group-hover:text-white mr-5">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6a2.25 2.25 0 00-2.25 2.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15M12 9l-3 3m0 0l3 3m-3-3h12.75" />
                    </svg>
                    </span> 
                    Logout
                </a>
                    </form>
                </div>
                @endauth
                </ul>
                </div>
            </div>
            

            {{-- <div class="hidden lg:flex lg:items-center lg:justify-center lg:ml-10 lg:mr-auto lg:space-x-10">
                <a href="#" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Features </a>

                <a href="#" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Solutions </a>

                <a href="#" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Resources </a>

                <a href="#" title="" class="text-base text-black transition-all duration-200 hover:text-opacity-80"> Pricing </a>
            </div> --}}
            <div class='hidden lg:inline-flex'>
                <a href="{{route('eatingPlaces')}}" title="" class="{{ request()->routeIs('eatingPlaces') ? 'text-white bg-black focus:text-white' : 'text-black' }} hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold  border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white mr-2" role="button"> Featured places </a>
            @if(Auth::check())
            <a href="{{route('dashboard')}}" title="" class="{{ request()->routeIs('userDashboard') ? 'text-white bg-black focus:text-white' : 'text-black' }} hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white mr-2" role="button"> Dashboard </a>
            
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
            <a href="{{route('logout')}}" @click.prevent="$root.submit();" title="" class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold text-black border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white mr-2" role="button"> Logout </a>
            </form>
            @else
            
            <a href="{{ route('login') }}" title="" class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold text-black border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white ml-2" role="button"> Login</a>
            <a href="{{ route('register') }}" title="" class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold text-black border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white mx-2" role="button">Sign Up</a>
            @endif
            <a href="#" title="" class="hidden lg:inline-flex items-center justify-center px-5 py-2.5 text-base font-semibold text-black border-2 border-black hover:bg-black hover:text-white transition-all duration-200 focus:bg-black focus:text-white" role="button"> Contact Us </a>
            <livewire:user.cart-counter />
            </div>
        </div>
    </div>

    

 
        


    {{-- cart component --}}
    <livewire:user.cart-content />
</header>