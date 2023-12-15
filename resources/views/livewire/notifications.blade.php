


<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-xl font-bold mb-4">Your Notifications</h1>

                @if(is_array($userNotification) || $userNotification->isEmpty())
                <p class="text-gray-600">You have no new notifications.</p>
                @else
                    {{-- @foreach($userNotification as $notifications)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mt-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <strong>{{ $notifications->user->username ?? 'Unknown User' }}</strong>
                                    @if($notifications->type == 'comment')
                                        commented: "{{ $notifications->comment->content ?? 'on your post' }}"
                                    @elseif($notifications->type == 'like')
                                        liked your post.
                                    @endif
                                    on <a href="{{ route('posts.show', $notifications->post_id) }}" class="text-blue-500 hover:text-blue-600">post #{{ $notifications->post_id }}</a>
                                </div>
                                <span class="text-gray-600 semi-bold">{{$notifications->created_at->diffForHumans() }}</span>
                            </div>
                            @if(!$notifications->is_read)
                                <button wire:click="markAsRead({{ $notifications->id }})" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-md text-sm mt-2">
                                    Mark as Read
                                </button>
                            @endif
                        </div>
                    @endforeach --}}
                    @foreach($userNotification as $notifications)
    @php
    $latestComment = \App\Models\Comment::where('post_id', $notifications->post_id)->latest()->first();
    $commenterUsername = $latestComment ? $latestComment->user->username : 'Unknown User';
    @endphp

    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mt-4">
        <div class="flex items-center justify-between">
            <div>
                <strong>{{ $commenterUsername }}</strong>
                @if($notifications->type == 'comment')
                    commented: "{{ $latestComment->content ?? 'on your post' }}"
                @elseif($notifications->type == 'like')
                    liked your post.
                @endif
                on <a href="{{ route('posts.show', $notifications->post_id) }}" class="text-blue-500 hover:text-blue-600">post #{{ $notifications->post_id }}</a>
            </div>
            <span class="text-gray-600 semi-bold">{{$notifications->created_at->diffForHumans() }}</span>
        </div>
        @if(!$notifications->is_read)
            <button wire:click="markAsRead({{ $notifications->id }})" class="text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-md text-sm mt-2">
                Mark as Read
            </button>
        @endif
    </div>
@endforeach

                @endif
            </div>
        </div>
    </div>
</div>

