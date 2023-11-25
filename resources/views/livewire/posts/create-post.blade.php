<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
    <form wire:submit.prevent="store">
        <div class="mb-4">
            <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
            <input wire:model.defer="title" type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            @error('title') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="mb-6">
            <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
            <textarea wire:model.defer="content" id="content" name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
            @error('content') <span class="text-red-500">{{ $message }}</span> @enderror
        </div>

        <div class="flex items-center justify-between">
            <div class="flex items-center gap-4">
                <x-primary-button type="submit">{{ __('Save') }}</x-primary-button>
            </div>
        </div>
    </form>
</div>
