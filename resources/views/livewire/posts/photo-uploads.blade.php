{{-- <div class="p-4 mx-auto mt-3 h-4/5 md:p-8 md:w-3/5">
    <h2 class="my-2 text-lg font-semibold text-gray-700">Upload featured image</h2>
    <form wire:submit.prevent="uploadImage" enctype="multipart/form-data">
        <div class="bg-white rounded shadow">
            @if (session()->has('message'))
                <div class="p-2 m-2 text-green-900 bg-green-600 bg-opacity-25 rounded-md">
                    {{ session('message') }} <a href="{{ route('new-post') }}">Add another one</a>
                </div>
            @endif
            <div class="p-8">
                <label for="image" class="flex items-center justify-center text-3xl border-2 border-dashed rounded-sm w-3/3 h-60 bg-gray-50">
                    Choose image
                    <input type="file" id="image" accept="image/jpeg, image/png, image/gif"
                           wire:model="image" class="w-0 h-0"/>
                </label>
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                {{-- <button type="submit" class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md hover:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring focus:ring-blue-200 active:bg-blue-700 transition">
                    Upload
                </button> --}}
{{-- 
                <div class="flex items-center gap-4">
                    <x-primary-button type="submit">{{ __('Upload') }}</x-primary-button>
                </div>
            </div>
        </div>
    </form>
</div> --}} 
{{-- 
<div class="p-4 mx-auto mt-3 h-4/5 md:p-8 md:w-3/5">
    <h2 class="my-2 text-lg font-semibold text-gray-700">Upload Featured Image</h2>
    <form wire:submit.prevent="uploadImage" enctype="multipart/form-data">
        <div class="bg-white rounded shadow">
            @if (session()->has('message'))
                <div class="p-2 m-2 text-green-900 bg-green-600 bg-opacity-25 rounded-md">
                    {{ session('message') }}
                </div>
            @endif
            <div class="p-8">
                <label for="image" class="flex items-center justify-center text-3xl border-2 border-dashed rounded-sm w-full h-60 bg-gray-50 cursor-pointer">
                    Click to Choose Image
                    <input type="file" id="image" accept="image/jpeg, image/png, image/gif"
                           wire:model="image" class="hidden"/>
                </label>
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <x-primary-button type="submit">{{ __('Upload') }}</x-primary-button>
            </div>
        </div>
    </form>
</div>
 --}}
