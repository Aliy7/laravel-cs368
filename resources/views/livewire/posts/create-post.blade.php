
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <form wire:submit.prevent="store">
        <!-- Title Input -->
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input wire:model.defer="title" type="text" id="title" name="title" 
                   class="shadow appearance-none border rounded font-semibold w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Content Input -->
        <div class="mb-6">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
            <textarea wire:model.defer="content" id="content" name="content" 
                      class="shadow appearance-none font-semibold border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Image Upload Input -->
        <div class="mb-4">
            <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="imageUpload">Upload Photo (Optional)</label>
            <input class="block w-full text-sm text-gray-900 bg-gray-50 border border-gray-300 rounded-lg cursor-pointer focus:outline-none dark:text-gray-400 dark:bg-gray-700 dark:border-gray-600" 
                   type="file" wire:model.defer="image" id="imageUpload">
            @if ($image)
                <img src="{{ $image->temporaryUrl() }}" style="max-width: 500px; max-height: 300px;" />
            @endif
            @error('image') <span class="error text-red-500">{{ $message }}</span> @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-between">
            <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
        </div>
    </form>
</div>
