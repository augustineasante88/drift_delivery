
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Tasks') }}
    </h2>
</x-slot>

<div class="mx-4 sm:mx-0">   
  <!-- component -->
  <x-dialog />
  <x-notifications z-index="z-50" />
    <div class='w-full p-5'>
      <x-button icon="filter" primary rounded label="Filter" wire:click='openFilterModal' />
    </div>
    <div class="w-full p-5 items-center justify-center grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-3 space-y-5 sm:space-y-0 ">
        @forelse ($assignedOrders as $order )
            
        <div wire:click='openOrderDetailsModal({{$order->id}})' class="hover:cursor-pointer relative overflow-hidden rounded-md bg-white shadow-lg ">
          <div class="absolute top-0 h-2 w-full 
          @if($order->status == 4)
          bg-yellow-400
          @elseif($order->status == 2)
          bg-blue-400
          @elseif($order->status == 3)
          bg-purple-800
          @elseif($order->status == 5)
          bg-green-400
          @elseif($order->status == 1)
          bg-red-400
          @endif
          "></div>
          <div class="mt-5 mx-2 flex justify-between">
            <div class='text-gray-400 font-medium'>order #{{$order->id}}</div>
            <div>
              @if($order->status == 4)
              <span class="rounded-full bg-yellow-300 px-2 text-yellow-900">pending</span>
              @elseif($order->status == 2)
              <span class="rounded-full bg-blue-300 px-2 text-blue-900">picked up</span>
              @elseif($order->status == 3)
              <span class="rounded-full bg-purple-800 px-2 text-purple-200">arrived</span>
              @elseif($order->status == 5)
              <span class="rounded-full bg-green-300 px-2 text-green-900">delivered</span>
              @elseif($order->status == 1)
              <span class="rounded-full bg-red-300 px-2 text-red-900">cancelled</span>
              @endif
            </div>
          </div>
      
          <div class="m-2.5 flex items-center justify-between">
            <div class="text-3xl font-medium">${{$order->total}}</div>
            <div class="flex items-center space-x-1 text-gray-400">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
              </svg>
              <span class="font-medium text-gray-400">
                @if(empty($order->location))
                {{$order->new_location}}
                @else 
                {{$order->getLocation->name}}
                @endif
              </span>
            </div>
          </div>
      
      
          <div class="m-2.5 flex justify-between">
            <div class="text-gray-400 font-medium">{{$order->getUserInfo->name}}</div>
            <div class="flex space-x-2 items-center text-gray-400 font-medium">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z" />
              </svg>
              <span class='font-bold text-gray-800'>{{$order->getUserInfo->phone_number}}</span>
            </div>
          </div>
      
          <div class="m-2.5 text-gray-400 border-t mt-5 flex justify-center items-center space-x-2">
            <span wire:loading.remove wire:target='openOrderDetailsModal("{{$order->id}}")' class="">view detail</span>
            <svg wire:loading.remove wire:target='openOrderDetailsModal("{{$order->id}}")' xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
              <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
              <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
            </svg>
            <svg wire:loading wire:target="openOrderDetailsModal('{{$order->id}}')" class="text-blue-900" fill='blue' stroke="currentColor" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
      
          </div>
      
        </div>
        @empty 
            <p class='flex justify-center items-center text-2xl'>No task available</p>
        @endforelse

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
      <h2 class='text-base text-gray-700 mb-4 underline'>Special Instructions</h2>
      <div class="flex justify-between text-base font-medium text-gray-900">
        {{-- <p class="mt-0.5 text-sm text-gray-500">Location</p> --}}
        @if(!empty($specialInstructions))
        <p class="mt-0.5 text-sm text-gray-800 flex space-x-2 items-center font-semibold">
          {{$specialInstructions}}
        </p>
        @else 
        <p class="mt-0.5 text-sm text-gray-800 flex space-x-2 items-center font-semibold">
          N/A
        </p>
        @endif
      </div>
      <div class='mt-4 flex space-x-2 items-center'>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 21v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21m0 0h4.5V3.545M12.75 21h7.5V10.75M2.25 21h1.5m18 0h-18M2.25 9l4.5-1.636M18.75 3l-1.5.545m0 6.205l3 1m1.5.5l-1.5-.5M6.75 7.364V3h-3v18m3-13.636l10.5-3.819" />
        </svg>
        <p>
         @if(empty($centerName))
         No name available
         @else 
         {{$centerName}}
         @endif
        </p>
      </div>
    </div>
    <div class="border-t border-gray-200 py-6">
      <h2 class='text-base text-gray-700 mb-4 underline'>Customer Details & Delivery Information</h2>
      <div class="flex justify-between text-base font-medium text-gray-900">
        {{-- <p class="mt-0.5 text-sm text-gray-500">Location</p> --}}
        <p class="mt-0.5 text-sm text-gray-800 flex space-x-2 items-center font-semibold">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
          </svg>
          <span>
          @if(empty($location))
          {{$newLocation}}
          @else 
          {{$location}}
          @endif  
          </span>
        </p>
      </div>
      <div class="flex justify-between text-base font-medium text-gray-900">
        <p class="mt-0.5 text-sm text-gray-800 font-semibold flex items-center space-x-2">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0zM4.501 20.118a7.5 7.5 0 0114.998 0A17.933 17.933 0 0112 21.75c-2.676 0-5.216-.584-7.499-1.632z" />
          </svg>
          <span>
          {{$username}}
          </span>
        </p>
        <p class="mt-0.5 text-sm text-gray-800 font-semibold flex space-x-2 items-center">
          <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
            <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 9.75v-4.5m0 4.5h4.5m-4.5 0l6-6m-3 18c-8.284 0-15-6.716-15-15V4.5A2.25 2.25 0 014.5 2.25h1.372c.516 0 .966.351 1.091.852l1.106 4.423c.11.44-.054.902-.417 1.173l-1.293.97a1.062 1.062 0 00-.38 1.21 12.035 12.035 0 007.143 7.143c.441.162.928-.004 1.21-.38l.97-1.293a1.125 1.125 0 011.173-.417l4.423 1.106c.5.125.852.575.852 1.091V19.5a2.25 2.25 0 01-2.25 2.25h-2.25z" />
          </svg>
          <span>
          {{$phoneNumber}} 
          </span>
        </p>
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
    {{-- @if(!empty($bikerName))
    <div class='mt-8 border-t'>
      <h3 class='text-lg font-normal flex'>Your delivery guy is <span class='text-blue-500 ml-1'>{{$bikerName}}</span></h3>
      <div class='flex justify-between items-center mt-4'>

        <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-md border border-gray-200">
          <img src="{{asset('storage/users_pictures/'.$bikerImage)}}" alt="image" class="h-full w-full object-cover object-center">
        </div>
        <div class='flex justify-center items-center space-x-4'>
          <p><x-icon name="phone" class="w-5 h-5" solid /></p>
          <p class='text-lg'>{{$bikerPhoneNumber}}</p>
        </div>

      </div>
    </div>
    @endif --}}

  <x-slot name="footer">
      <div class="flex justify-between gap-x-4">
        @if($orderStatus == 4)
          <x-button flat negative label="Cancel Order" wire:click="cancelOrder({{$orderId}})" />
        @else 
        <p></p>
        @endif

          <div class="flex">
            <x-button flat label="Close" x-on:click="close" />

            @if($orderStatus == 4)
            <x-button primary label="Confirm Pickup" wire:click="confirmPickup" />
            @elseif($orderStatus == 1)
            <x-button outline negative label="Order Cancelled" />
            @elseif($orderStatus == 3)
            <x-button outline emerald wire:click='completeDelivery' label="complete delivery" />
            @elseif($orderStatus == 2)
            <x-button emerald label="Confirm Arrival" wire:click="confirmArrival" />
            @endif
          </div>
      </div>
  </x-slot>
</x-modal.card>

{{-- search filter --}}
<x-modal.card title="Filter" blur wire:model.defer="filterModal">
 
    <div class="border-gray-200 py-6 max-w-2xl">
      <h2 class='text-base text-gray-700 mb-4 underline'>Search by: Phone number Or Order Id</h2>
      <div class="flex w-full text-base font-medium text-gray-900">
        <x-input icon="search" wire:model='search' label="" placeholder="your name" class='w-full' />
      </div>
    </div>

    <div class="border-gray-200 py-6 w-full">
      <h2 class='text-base text-gray-700 mb-4 underline'>Filter by delivery status</h2>
      <div class="flex w-full text-base font-medium text-gray-900">
        <x-native-select label="" wire:model="delivery_status">
          <option>Select</option>
          <option value='4'>Pending</option>
          <option value='5'>Delivered</option>
          <option value='2'>Picked up</option>
          <option value='1'>Cancelled</option>
        </x-native-select>
        
      </div>
    </div>
    <div class="border-gray-200 py-6 w-full">
      <h2 class='text-base text-gray-700 mb-4 underline'>Filter by date range</h2>
      <div class="flex w-full text-base font-medium text-gray-900 space-x-4">
        {{-- <x-datetime-picker
        label="Start Date"
        placeholder="Appointment Date"
        display-format="DD-MM-YYYY HH:mm"
        wire:model.defer="startDate"
        /> --}}
        <input type='date' wire:model='startDate' />
        <input type='date' wire:model='endDate' />
        {{-- <x-datetime-picker
        label="End Date"
        placeholder="Appointment Date"
        display-format="DD-MM-YYYY HH:mm"
        wire:model.defer="endDate"
        /> --}}
        
      </div>
    </div>

  <x-slot name="footer">
      <div class="flex justify-between gap-x-4"> 

        <div>
          <x-button flat label="Close" x-on:click="close" />
        </div>
        <div class='space-x-2'>
          <x-button outline warning wire:click='resetFilters' label="reset filters" />
        <x-button primary label="Done" x-on:click="close" />
        </div>
      </div>
  </x-slot>
</x-modal.card>
          
</div>