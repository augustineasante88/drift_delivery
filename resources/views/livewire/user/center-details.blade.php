<div class="bg-gradient-to-b from-blue-50 to-blue-100">
    <x-notifications />
    <x-frontend-header />

    <section class="mx-16">
        <h1 class="text-blue-900 text-xl font-bold font-serif pl-2 text-center mt-8"> {{$center->name}}</h1>
        <span class="text-blue-900 text-2xl text-center flex justify-center mt-2">Choose from the following categories</span>
       
    </section>

    <section class="mx-8 overflow-auto soft-scrollbar flex justify-start sm:justify-center gap-3 mt-12">

        <button 
        wire:click="resetActiveCategory" 
        class="@if($selectedCategory == '') bg-blue-900 text-white @endif flex items-center justify-center space-x-3 border border-gray-400 px-6 py-2 rounded-full border-opacity-50 mb-4"
        >
       <p>
        All
       </p>
        <svg wire:loading wire:target='resetActiveCategory'  class="text-white" fill='blue' stroke="currentColor" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
 
    </button>
            @foreach ($categories as $category)
            {{-- <div wire:click='setActiveCategory({{$category->id}})' class="w-full cursor-pointer rounded overflow-hidden shadow-lg relative">
                <div class="bg-black inset-0 absolute opacity-60"></div>
                <img class="w-full h-36 object-cover" src="https://images.unsplash.com/photo-1540189549336-e6e99c3679fe?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxleHBsb3JlLWZlZWR8NXx8fGVufDB8fHx8&auto=format&fit=crop&w=500&q=60" alt="Sunset in the mountains">
                <div class="font-bold text-xl mb-2 absolute bottom-4 text-center left-20 right-20 text-white z-10">{{$category->name}}</div>

                @if($category->id == $selectedCategory )
                <div class='h-6 w-6 rounded-full bg-white absolute top-4 right-4 z-50'>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21c-1.268 0-2.39-.63-3.068-1.593a3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                    </svg>
                </div>
                @endif
            </div> --}}
            <button 
                 wire:click="setActiveCategory({{$category->id}})" 
                 class="@if($selectedCategory == $category->id) bg-blue-900 text-white @endif flex items-center justify-center space-x-3 border border-gray-400 px-3 md:px-6 py-1 rounded-full border-opacity-50 mb-4"
                >
                <p>
                 {{$category->name}}
                </p>
                 <svg wire:loading wire:target='setActiveCategory({{$category->id}})' class="text-white" fill='blue' stroke="currentColor" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
            </button>
            @endforeach

    </section>

    <section class="mx-16">
        <span class="text-blue-900 text-2xl text-center flex justify-center mt-20 font-bold font-serif">

            @if(empty($selectedCategory))
            All Menu
            @else 
            {{$selectedCategoryName}}
            @endif
        </span>
        <p class="text-lg text-center">Sweet or salty, we have the perfect combination</p>
    </section>

    <section class="py-12">
        <div class="px-4 mx-auto sm:px-6 lg:px-8 max-w-7xl">
    
            <div class="grid grid-cols-2 gap-8 mt-10 lg:gap-4 lg:grid-cols-4">
                @forelse ($foods as $food)
                    
                <div class="relative group">
                    <div class="overflow-hidden aspect-w-1 aspect-h-1">
                        <img class="object-cover w-full h-56 transition-all duration-300 group-hover:scale-125 rounded-md" src="{{asset('storage/food_pictures/'.$food->image)}}" alt="" />
                    </div>
                    <div class="absolute left-3 top-3">
                        <p class="sm:px-3 sm:py-1.5 px-1.5 py-1 text-[8px] sm:text-xs font-bold tracking-wide text-gray-900 uppercase bg-white rounded-full">New</p>
                    </div>
                    <div class="flex items-start justify-between mt-4 space-x-4">
                        <div>
                            <h3 class="text-xs font-bold text-gray-900 sm:text-sm md:text-base">
                                <a wire:click='addFoodToCart({{$food->id}})' title="">
                                    {{$food->name}}
                                    <span class="absolute inset-0" aria-hidden="true"></span>
                                </a>
                            </h3>
                            <div class="flex items-center mt-2.5 space-x-px w-full">
                                <button class="px-6 py-2 rounded-full bg-blue-900 text-white mb-6 flex space-x-3" >
                                    <p class="text-xs  ">add to cart</p>
                                    <svg wire:loading wire:target="addFoodToCart('{{$food->id}}')" class="text-white" fill='white' stroke="currentColor" width="12" height="12" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><style>.spinner_qM83{animation:spinner_8HQG 1.05s infinite}.spinner_oXPr{animation-delay:.1s}.spinner_ZTLf{animation-delay:.2s}@keyframes spinner_8HQG{0%,57.14%{animation-timing-function:cubic-bezier(0.33,.66,.66,1);transform:translate(0)}28.57%{animation-timing-function:cubic-bezier(0.33,0,.66,.33);transform:translateY(-6px)}100%{transform:translate(0)}}</style><circle class="spinner_qM83" cx="4" cy="12" r="3"/><circle class="spinner_qM83 spinner_oXPr" cx="12" cy="12" r="3"/><circle class="spinner_qM83 spinner_ZTLf" cx="20" cy="12" r="3"/></svg>
                                </button> 
                               
                            </div>
                        </div>
    
                        <div class="text-right">
                            <p class="text-xs font-bold text-gray-900 sm:text-sm md:text-base">${{$food->price}}</p>
                        </div>
                    </div>
                </div>
                @empty 
                <h1 class='text-2xl text-blue-900'>Nothing Found</h1>
                @endforelse
            </div>
        </div>
    </section>

</div>