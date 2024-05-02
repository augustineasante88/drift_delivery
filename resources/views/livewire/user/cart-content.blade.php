<div class="relative z-10" aria-labelledby="slide-over-title" role="dialog" aria-modal="true" x-cloak x-show="cartOpen">
    <!--
      Background backdrop, show/hide based on slide-over state.
  
      Entering: "ease-in-out duration-500"
        From: "opacity-0"
        To: "opacity-100"
      Leaving: "ease-in-out duration-500"
        From: "opacity-100"
        To: "opacity-0"
    -->
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
  
    <div class="fixed inset-0 overflow-hidden">
      <div class="absolute inset-0 overflow-hidden">
        <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
          <!--
            Slide-over panel, show/hide based on slide-over state.
  
            Entering: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-full"
              To: "translate-x-0"
            Leaving: "transform transition ease-in-out duration-500 sm:duration-700"
              From: "translate-x-0"
              To: "translate-x-full"
          -->
          <div class="pointer-events-auto w-screen max-w-md" @click.away="cartOpen = false">
            <div class="flex h-full flex-col bg-white shadow-xl">
              <div class="flex-1 overflow-y-auto soft-scrollbar py-6 px-4 sm:px-6">
                <div class="flex items-start justify-between">
                  <h2 class="text-lg font-medium text-gray-900" id="slide-over-title">Drift cart</h2>
                  <div class="ml-3 flex h-7 items-center">
                    <button @click="cartOpen = false" type="button" class="-m-2 px-2 border-2 rounded-md border-indigo-600  text-gray-600 hover:text-gray-500">
                      close
                    </button>
                  </div>
                  
                </div>
                <button class='w-full flex bg-blue-100 text-blue-800 text-center rounded-lg space-x-4 items-center justify-center mt-4' wire:click='refreshCartContent' wire:loading.remove>
                  <span>refresh cart content</span> 

                  <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                  </svg>
                </button>

                <div wire:loading wire:target='refreshCartContent' class='flex w-full justify-center items-center bg-blue-100 text-blue-800 rounded-lg space-x-4 mt-4'>
                  <p class='flex justify-center text-center'>
                  loading...
                  </p>
                </div>
  
                <div class="mt-8">
                  <div class="flow-root">
                   
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
                </div>
              </div>
  
              <div class="border-t border-gray-200 py-6 px-4 sm:px-6">
                <div class="flex justify-between text-base font-medium text-gray-900">
                  <p>Subtotal</p>
                  <p>{{$subTotal}}</p>
                </div>
                <p class="mt-0.5 text-sm text-gray-500">Shipping and taxes calculated at checkout.</p>
                <div class="mt-6">
                  <a href="{{route('checkout')}}" class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Checkout</a>
                </div>
                <div class="mt-6 flex justify-center text-center text-sm text-gray-500">
                  <p>
                    or
                    <button type="button" class="font-medium text-indigo-600 hover:text-indigo-500">
                      Continue Shopping
                      <span aria-hidden="true"> &rarr;</span>
                    </button>
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
