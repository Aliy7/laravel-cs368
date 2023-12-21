
<x-app-layout>
    <div class="dark:bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
            <div>
                <!-- Other content, if any, can go here -->
            </div>
            <div class="text-right text-bold text-danger text-blue-500">
                @if(auth()->check()) <!-- Check if user is authenticated -->
                @if(auth()->user()->hasRole('admin')) <!-- Check if user is admin -->
                    <span class="text-right">{{ __("Logged in as Admin!") }}</span>
                @elseif(auth()->user()->hasRole('mod'))
                    <span class="text-right">{{ __("Logged in as Mod!") }}</span>
                @else
                    <span class="">{{ __("Logged in as ") . auth()->user()->username }}</span>
                @endif
            @else
                <span class="text-right">{{ __("You're not logged in.") }}</span>
            @endif
            
        </div>
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
