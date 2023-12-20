
<x-app-layout>
    <div class="dark:bg-gray-400 overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-between items-center">
            <div>
                <!-- Other content, if any, can go here -->
            </div>
            <div>
                @if(auth()->check()) <!-- Check if user is authenticated -->
                    @if(auth()->user()->is_admin && auth()) <!-- Check if user is admin -->
                        <span class="text-right">{{ __("You're logged in as Admin!") }}</span>
                    @elseif(auth()->user()->is_mod && auth())
                        <span class="text-right">{{ __("You're logged in as Mod!") }}</span>
                    @else
                        <span class="text-right">{{ __("You're logged in as ") . auth()->user()->username }}</span>
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
