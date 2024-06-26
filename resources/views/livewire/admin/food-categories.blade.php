
<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Food Categories') }}
    </h2>
</x-slot>

<div class="mx-4 sm:mx-0">   <!-- component -->

<div class="overflow-x-auto">
    <div class="min-w-screen my-12 bg-gray-100 flex items-center justify-center font-sans">
        <div class="w-full lg:w-5/6">
            <div class='w-full lg:w-5/6 my-4'>
                <x-button rounded dark label="Add New Food Category" wire:click='openAddCategoryModal' />
            </div>

            <div class="bg-white shadow-md rounded">
                <table class="min-w-max w-full table-auto">
                    <thead>
                        <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Name</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-600 text-sm font-light">
                        @forelse($categories as $category)
                        <tr class="border-b border-gray-200 hover:bg-gray-100">
                            <td class="py-3 px-6 text-left whitespace-nowrap">
                                <div class="flex items-center">
                                    <span class="font-medium">{{$category->name}}</span>
                                </div>
                            </td>
                            {{-- <td class="py-3 px-6 text-center">
                                <span class="bg-purple-200 text-purple-600 py-1 px-3 rounded-full text-xs">Active</span>
                            </td> --}}
                            <td class="py-3 px-6 text-center">
                                <div class="flex item-center justify-center">
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                    <div class="w-4 mr-2 transform hover:text-purple-500 hover:scale-110">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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
                    {{$categories->links()}}
                </div>
            </div>
        </div>
    </div>
</div>


{{-- add new center modal --}}
<x-modal wire:model.defer="addCategoryModal">
    <x-card title="Add New Food Category">
        <div class='mt-2' >
            <x-input label="Name" wire:model.debounce.1000ms='name' placeholder="name" />
        </div>
        <x-slot name="footer">
            <div class="flex justify-end gap-x-4">
                <x-button rounded label="Cancel" x-on:click="close" />
                <x-button rounded primary label="save" wire:click='addCategory' />
            </div>
        </x-slot>
    </x-card>
</x-modal>
{{-- end of modal --}}
          
</div>
