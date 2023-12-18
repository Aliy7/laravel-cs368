<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h1 class="text-xl font-bold mb-4">Your Notifications</h1>

                @if(is_array($userNotification) || $userNotification->isEmpty())
                    <p class="text-gray-600">You have no new notifications.</p>
                @else
                    @foreach ($userNotification as $notification)
                        @php
                            $comment = \App\Models\Comment::find($notification->comment_id);
                        @endphp

                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mt-4 shadow">
                            <div class="flex justify-between items-center mb-2">
                                <div class="font-semibold text-blue-500">
                                    {{ $notification->created_at->diffForHumans() }}
                                </div>
                                <div>
                                    <strong class="font-semibold text-blue-500 text-right">{{ $comment->user->username ?? 'Unknown User' }}</strong>
                                    <span class=" font-semibold text-right "><i>commented on your post </i></span>
                                </div>
                            </div>
                            <div class="mb-2 text-white-600 font-semibold">
                                "{{ $comment->content ?? 'Comment content not available' }}"
                            </div>
                            @if (!$notification->is_read)
                                <button wire:click="markAsRead({{ $notification->id }})"
                                    class="mt-3 text-white bg-blue-500 hover:bg-blue-600 px-3 py-1 rounded-md text-sm">
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
