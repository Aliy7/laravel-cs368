<div>
    @if (session()->has('message'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
        <span class="block sm:inline">{{ session('message') }}</span>
    </div>
    @endif

    @if (session()->has('error') && $tryEditing)
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
        <strong class="font-bold">Sorry!</strong>
        <span class="block sm:inline">{{ session('error') }}</span>
    </div>
    @endif

    <!-- Editable Content Section -->
    @if (!$isEditing)
        <!-- Non-edit Mode -->
        <div class="p-4">
            <button wire:click="edit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
        </div>
    @else
        <!-- Edit Mode -->
        <form wire:submit.prevent="updateComment" class="p-4">
            <div class="mb-4">
                <textarea wire:model.defer="content" class="w-full h-15 bg-white font-semibold border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700"></textarea>
                @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center justify-start space-x-4">
                <button type="submit" class="bg-blue-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded">Save</button>
                <button wire:click="cancelEdit" type="button" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Cancel</button>
            </div>
        </form>
    @endif
</div>
