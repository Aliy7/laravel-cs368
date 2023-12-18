{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<h1> Hi are you still there</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    {{-- <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot> --}}


    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100">
            @if(auth()->check()) <!-- Check if user is authenticated -->
                @if(auth()->user()->is_admin) <!-- Check if user is admin -->
                    {{ __("You're logged in as Admin!") }}
                @else
                    {{ __("You're logged in as ") . auth()->user()->username }}
                @endif
            @else
                {{ __("You're not logged in.") }}
            @endif
        </div>
    
    @livewire('post.create-post')
    @livewire('post.show-post')


    {{-- @livewire('quote.show-quote') --}}
    {{-- @livewire('display.post-comment-display') --}}

                 <a href="/" > welcome</a>
                </div>
                
        </div>
    </div>

</x-app-layout>
