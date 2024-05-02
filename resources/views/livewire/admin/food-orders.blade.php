
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Orders') }}
    </h2>
</x-slot>

<div class="mx-4 sm:mx-0">   <!-- component -->
    <x-dialog />
<div class="overflow-x-auto">
    <div class="min-w-full my-12 bg-gray-100 flex items-center justify-center font-sans">
        <div class="w-full lg:w-5/6">
            {{-- <div class='w-full lg:w-5/6 my-4'>
                <x-button rounded dark label="Add New Food" wire:click='openAddFoodModal' />
            </div> --}}

            <div class="bg-white shadow-md rounded">
                <table class="min-w-max w-full">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Order ID</th>
                            <th class="py-3 px-6 text-left">Price</th>
                            <th class="py-3 px-6 text-center">Date</th>
                            <th class="py-3 px-6 text-center">Center</th>
                            <th class="py-3 px-6 text-center">Location</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            {{-- <th class="py-3 px-6 text-center">Dellivery Status</th> --}}
                            {{-- {{-- <th class="py-3 px-6 text-center">Image</th> --}}
                            <th class="py-3 px-6 text-center">Assignee</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse($orders as $order)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">#{{$order->id}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">ghc {{$order->total}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <div class="flex justify-center">
                                    <span>{{$order->created_at}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <div class="flex justify-center">
                                    <span>
                                        @if(!empty($order->location))
                                        {{$order->getLocation->name}}
                                        @else 
                                        {{$order->new_location}}
                                        @endif
                                    </span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <div class="flex justify-center">
                                    <span>{{$order->getCenterName->name}}</span>
                                </div>
                            </td>
                            <td class="py-3 px-6 text-right">
                                <div class="flex justify-center">
                                    @if($order->status == 4)
                                    <span class='px-4 bg-yellow-100 text-yellow-800 rounded-full'>pending</span>
                                    @elseif($order->status == 1)
                                    <span class='px-4 bg-red-100 text-red-800 rounded-full'>cancelled</span>
                                    @elseif($order->status == 2)
                                    <span class='px-4 bg-blue-100 text-blue-800 rounded-full'>Picked up</span>
                                    @elseif($order->status == 3)
                                    <span class='px-4 bg-purple-100 text-purple-800 rounded-full'>Arrived</span>
                                    @elseif($order->status == 5)
                                    <span class='px-4 bg-green-100 text-green-800 rounded-full'>Delivered</span>
                                    @endif
                                </div>
                            </td>
                            {{-- <td class="py-3 px-6 text-right">
                                <div class="flex justify-center">
                                    @if($order->delivery_status == 0)
                                    <span>Not Delivered</span>
                                    @elseif($order->delivery_status == 1)
                                    <span>picked up</span>
                                    @elseif($order->delivery_status == 2)
                                    <span>Delivered</span>
                                    @endif
                                </div>
                            </td> --}}
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    @if(empty($order->assignee))
                                    <span class="font-medium">N/A</span>
                                    @else 
                                    <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">
                                    {{$order->getBikerInfo->name}}
                                    </span>
                                    @endif
                                </div>
                            </td>
                            
                            {{-- <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
                            </td> --}}
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg wire:click="openOrderDetails({{$order->id}})" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr class="bg-white hover:bg-gray-50 dark:hover:bg-gray-600">
                            <td colspan="6">
                                <div class='flex flex-col justify-center items-center m-4'>
                                <img src='{{asset('my-assets/no-data.png')}}' class='w-40 h-40' />
                                <div>No Data found</div>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    
                </table>
                <div class='mx-12 py-2'>
                    {{$orders->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


        {{-- item details modal --}}
        <x-modal.card title="Order Details" blur wire:model.defer="orderDetailsModal">
            <div class="mt-8 mb-2">
                <div class="flow-root">
                 
                  <ul role="list" class="-my-6 divide-y divide-gray-200">
                      @forelse ($items as $item )
                          
                      <li class="flex py-6">
                      <div class="h-16 w-16 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
                        <img src="{{asset('storage/food_pictures/'.$item->getFoodDetails->image)}}" alt="image" class="h-full w-full object-cover object-center">
                      </div>
        
                      <div class="ml-4 flex flex-1 flex-col">
                        <div>
                          <div class="flex justify-between text-base font-medium text-gray-900">
                            <h3>
                              <a href="#">{{$item->getFoodDetails->name}}</a>
                            </h3>
                            <p class="ml-4">{{$item->food_price}}</p>
                          </div>
                          {{-- <p class="mt-1 text-sm text-gray-500">Salmon</p> --}}
                        </div>
                        <div class="flex flex-1 items-end justify-between text-sm">
                          <p class="text-gray-500 flex space-x-2 justify-center items-center">Qty 
                              <span class='text-xl font-bold text-gray-900 ml-2 flex justify-center items-center'>
                                  {{$item->quantity}}
                              </span>
                          </p>
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
              <div class="border-t border-gray-200 py-6">
                <div class="flex justify-between text-base font-medium text-gray-900">
                  <p class="mt-0.5 text-sm text-gray-500">Subtotal</p>
                  <p class="mt-0.5 text-sm text-gray-500">{{$subTotal}}</p>
                </div>
                <div class="flex justify-between text-base font-medium text-gray-900">
                <p class="mt-0.5 text-sm text-gray-500">Delivery fee</p>
                <p class="mt-0.5 text-sm text-gray-500">5</p>
                </div>
                <div class="flex justify-between text-base font-medium text-gray-900">
                  <p>Total</p>
                  <p>{{$total}}</p>
                </div>
              </div>
              <div class='mt-8 border-t w-full pt-6'>
                  <x-select
                  label="Assign Biker"
                  wire:model.defer="biker"
                  placeholder="Select some user"
                  :async-data="route('bikersInfo')"
                  option-label="name"
                  option-value="id"
                  />

                  @if(empty($biker))
                  <button wire:loading.remove wire:click='assignBiker' class='px-4 py-0 hover:bg-blue-200 rounded-sm text-blue-500 border mt-2'>save</button>
                  @else 
                  <button wire:loading.remove wire:click='assignBiker' class='px-4 py-0 hover:bg-blue-200 rounded-sm text-blue-500 border mt-2'>update</button>
                  @endif
                  <svg wire:loading wire:target='assignBiker' class="text-white" fill='blue' stroke="currentColor" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
              </div>
         
            <x-slot name="footer">
                <div class="flex justify-between gap-x-4">
                   
                  <p></p>
         
                    <div class="flex">
                        <x-button flat label="Close" x-on:click="close" />
                        {{-- <x-button primary label="Save" wire:click="save" /> --}}
                    </div>
                </div>
            </x-slot>
        </x-modal.card>
{{-- end of modal --}}
          
</div>
