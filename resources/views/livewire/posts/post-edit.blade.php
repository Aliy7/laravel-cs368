{{-- 
     <div>
        <!-- Error Message -->
        @if (session()->has('error') && $isEditing)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Oops!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif
    
        <!-- Editable Content Section -->
        <div x-data="{ isEditing: @entangle('isEditing') , showError:false}">
            <!-- Non-edit Mode -->
            <template x-if="!isEditing">
                <div class="p-4">
                    <button @click="isEditing = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Edit</button>
                </div>
            </template>
    
            <!-- Edit Mode -->
            <template x-if="isEditing">
                <form wire:submit.prevent="updatePost" class="p-4">
                    <div class="mb-4">
                        <input type="text" wire:model="title" class="w-full w-full h-14 bg-white font-semibold border-black-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="mb-4">
                        <textarea wire:model="content" class="w-full h-15 bg-white font-semibold border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700"></textarea>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex items-center justify-start space-x-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Save</button>
                        <button type="button" @click="isEditing = false" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Cancel</button>
                    </div>
                </form>
            </template>
        </div>
    </div>
     --}}

     {{-- <div>
        <!-- Error Message -->
        @if (session()->has('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif
    
        <!-- Editable Content Section -->
        <div x-data="{ isEditing: @entangle('isEditing') }">
            <!-- Non-edit Mode -->
            <template x-if="!isEditing">
                <div class="p-4">
                    <button @click="$wire.call('edit')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                </div>
            </template>
    
            <!-- Edit Mode -->
            <template x-if="isEditing">
                <form wire:submit.prevent="updatePost" class="p-4">
                    <div class="mb-4">
                        <input type="text" wire:model="title" class="w-full h-14 bg-white font-semibold border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="mb-4">
                        <textarea wire:model="content" class="w-full h-15 bg-white font-semibold border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700"></textarea>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex items-center justify-start space-x-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        <button @click="$wire.call('cancelEdit')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    </div>
                </form>
            </template>
        </div>
    </div>
     --}}

     <div>
        {{-- <!-- Error Message -->
        @if (session()->has('error') && $attemptedEdit)
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Oops!</strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif --}}
        <!-- Error Message -->
        @if (session()->has('error') && $attemptedEdit)
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Sorry!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

        <!-- Editable Content Section -->
        <div x-data="{ isEditing: @entangle('isEditing') }">
            <!-- Non-edit Mode -->
            <template x-if="!isEditing">
                <div class="p-4">
                    <button @click="$wire.call('edit')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                </div>
            </template>
    
            <!-- Edit Mode -->
            <template x-if="isEditing">
                <form wire:submit.prevent="updatePost" class="p-4">
                    <div class="mb-4">
                        <input type="text" wire:model="title" class="w-full h-14 bg-white font-semibold border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700">
                        @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="mb-4">
                        <textarea wire:model="content" class="w-full h-15 bg-white font-semibold border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700"></textarea>
                        @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                    </div>
    
                    <div class="flex items-center justify-start space-x-4">
                        <button type="submit" class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                        <button @click="$wire.call('cancelEdit')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
                    </div>
                </form>
            </template>
        </div>
    </div>
    