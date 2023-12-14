<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>
    
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-profile-information-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.update-password-form />
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <livewire:profile.delete-user-form />
                </div>
            </div>
        </div>
    </div>
          <!-- ... existing content ... -->
    
        <!-- New Section for User's Posts -->
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 shadow sm:rounded-lg p-4 sm:p-8">
                    <h3 class="text-lg font-semibold mb-4">Your Posts</h3>
                    @foreach ($user->posts as $post)
                        <div class="mb-4">
                            <div class="text-lg font-semibold">{{ $post->title }}</div>
                            <div class="text-gray-600">{{ $post->content }}</div>
                            <div class="text-gray-600">{{ $post->user->username}}</div>

                            <!-- Add more post details as needed -->
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    
</x-app-layout>

