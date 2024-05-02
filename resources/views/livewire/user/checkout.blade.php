<div class="grid sm:px-10 lg:grid-cols-2 lg:px-20 xl:px-32 gap-2 mb-12">
    <div class="px-4 pt-8 bg-gray-50 rounded-md">
      @if(empty(Auth::user()->phone_number) && !empty(Auth::check()))
      <p class='text-base text-red-600 '>Click <a class='text-blue-600 underline decoration-blue-600' href='{{route('profile')}}'>here</a> to update your contact details before you can proceed to checkout.</p>
      @endif
      @if(empty(Auth::check()))
      <p class='text-red-600 mb-2'>You are currently not logged in. Please <a href="{{route('login')}}" class='text-blue-700 underline decoration-blue-500'>login</a> before proceeding to checkout. </p>
      @endif
      <p class="text-xl font-medium">Order Summary</p>
      <p class="text-gray-400">Check your items. And add special instructions if you have any, before ordering.</p>
      <div class="mt-8 space-y-3 rounded-lg border bg-white px-2 py-4 sm:px-6">
        <ul role="list" class="-my-6 divide-y divide-gray-200">
            @forelse ($items as $item )
                
            <li class="flex py-6">
            <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
              <img src="{{asset('storage/food_pictures/'.$item->options->image)}}" alt="image" class="h-full w-full object-cover object-center">
            </div>

            <div class="ml-4 flex flex-1 flex-col">
              <div>
                <div class="flex justify-between text-base font-medium text-gray-900">
                  <h3>
                    <a href="#">{{$item->name}}</a>
                  </h3>
                  <p class="ml-4">{{$item->price}}</p>
                </div>
                {{-- <p class="mt-1 text-sm text-gray-500">Salmon</p> --}}
              </div>
              <div class="flex flex-1 items-end justify-between text-sm">
                <p class="text-gray-500 flex space-x-2 justify-center items-center">Qty 
                    <span class='text-xl font-bold text-gray-900 ml-2 flex justify-center items-center'>
                        <svg wire:click="decreaseItemQty('{{$item->rowId}}')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                            
                        {{$item->qty}}
                        <svg wire:click="increaseItemQty('{{$item->rowId}}')" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 ml-2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </span>
                </p>

                <div class="flex">
                  <button wire:click="removeItemFromCart('{{$item->rowId}}')" type="button" class="font-medium text-indigo-600 hover:text-indigo-500">Remove</button>
                </div>
              </div>
            </div>
            </li>
            @empty
            <div class='w-full h-full flex flex-col space-y-4 justify-center items-center mt-16'> 
            <h3 class='text-xl text-blue-900'>empty cart</h3>
            <img class='w-40 h-40' src="{{asset('my-assets/images/empty.png')}}" />
            </div>
            @endforelse

          <!-- More products... -->
        </ul>
      </div>
  
      <p class="mt-8 text-lg font-medium">Payment Methods</p>
      <form class="mt-5 grid gap-6">
        <div class="relative pb-4">
          <input class="peer hidden" id="radio_1" type="radio" name="radio" checked />
          <span class="peer-checked:border-gray-700 absolute right-4 top-1/2 box-content block h-3 w-3 -translate-y-1/2 rounded-full border-8 border-gray-300 bg-white"></span>
          <label class="peer-checked:border-2 peer-checked:border-gray-700 peer-checked:bg-gray-50 flex cursor-pointer select-none rounded-lg border border-gray-300 p-4" for="radio_1">
            {{-- <img class="w-14 object-contain" src="/images/naorrAeygcJzX0SyNI4Y0.png" alt="" /> --}}
            <div class="ml-5">
              <span class="mt-2 font-semibold">Currently Only Cash On Delivery</span>
              {{-- <p class="text-slate-500 text-sm leading-6">Delivery: 2-4 Days</p> --}}
            </div>
          </label>
        </div>
      </form>
    </div>
    <div class="mt-10 bg-gray-50 px-4 pt-8 lg:mt-0 rounded-md space-y-4 py-6">
      <p class="text-xl font-medium">Delivery Details</p>
      <p class="text-gray-400">Complete your order by providing your delivery details.</p>
      <div class="">
        {{-- @if($newLocation == false) --}}
        <label for="location" class="mt-4 mb-2 block text-sm font-medium">Choose location</label>
        <div class="relative">
          <x-select
              {{-- label="Search for location" --}}
              wire:model.defer="location"
              placeholder="Select location"
              :async-data="route('locations')"
              option-label="name"
              option-value="id"
          />
        </div>
        {{-- @endif --}}
        @if($nnewLocation)
        <x-button class="mt-4" wire:click="hideNewLocation" rounded icon='minus' label="Remove new location" spinner='hideNewLocation'/>
        @else
        <x-button class="mt-4" wire:click="showNewLocation" rounded icon='plus' label="Add new location" spinner='showNewLocation'/>
        @endif
        {{-- <button wire:click='showNewLocation'>add </button> --}}

        @if($nnewLocation)
       
        <div class="relative mt-5">
          <x-input icon="map" wire:model.defer='newLocation' label="Add new location" placeholder="new location" />
          {{-- @error('newAddressLocation')<span class='text-red-600'>{{$message}}</span>@enderror --}}

        </div>
        @endif

        <label for="card-holder" class="mt-4 mb-2 block text-sm font-medium">Special Instruction</label>
        <div class="relative">
          <textarea wire:model='specialInstructions' type="text" id="card-holder" name="card-holder" class="w-full rounded-md border border-gray-200 px-4 py-3 text-sm shadow-sm outline-none focus:z-10 focus:border-blue-500 focus:ring-blue-500" placeholder="Add special instruction to your order">
          </textarea>
          {{-- @error('specialInstructions')<span class='text-red-600'>{{$message}}</span>@enderror --}}
        </div>
  
        <!-- Total -->
        <div class="mt-6 border-t border-b py-2">
          <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Subtotal</p>
            <p class="font-semibold text-gray-900">{{$subTotals}}</p>
          </div>
          <div class="flex items-center justify-between">
            <p class="text-sm font-medium text-gray-900">Delivery fee</p>
            <p class="font-semibold text-gray-900">5</p>
          </div>
        </div>
        <div class="mt-6 flex items-center justify-between">
          <p class="text-sm font-medium text-gray-900">Total</p>
          <p class="text-2xl font-semibold text-gray-900">{{$subTotals + 5}}</p>
        </div>
      </div>
      {{-- <button class="mt-4 mb-8 w-full rounded-md bg-gray-900 px-6 py-3 font-medium text-white">Place Order</button> --}}
      @if(empty(Auth::user()->phone_number) && !empty(Auth::check()))
      <p class='text-base text-red-600 '>Click <a class='text-blue-600 underline decoration-blue-600' href='{{route('profile')}}'>here</a> to update your contact details before you can proceed to checkout.</p>
      @else
      <button wire:click="placeOrder" class="px-6 py-4 w-full justify-center rounded-full bg-blue-900 text-white mb-6 flex space-x-3" >
        <p>Place Order</p>
        <svg wire:loading wire:target="placeOrder" class="text-white" fill='white' stroke="currentColor" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
    </button> 
    @endif
    </div>
  </div>