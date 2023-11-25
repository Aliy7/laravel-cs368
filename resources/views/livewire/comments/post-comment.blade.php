<div>
    <!-- Display Comments -->
    <div class="comments mt-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
        <h4 class="font-semibold mb-2">Comments:</h4>
        @forelse ($post->comments as $comment)
            <div class="comment mb-2 p-2 border-b border-gray-300 dark:border-gray-700">
                <div class="flex justify-between items-center dark:text-gray-300">
                    <span>{{ $comment->content }}</span>
                    <a href="{{ route('profile.showProfile', $comment->user->id) }}" class="text-blue-500 hover:text-blue-700">
                        {{ $comment->user->username }}
                    </a>
                </div>
            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div>

    <!-- Add Comment Form -->
    @auth
        <form wire:submit.prevent="submitComment" class="mt-4">
            <textarea wire:model="comment_content" placeholder="Add a comment..." class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"></textarea>
            {{-- <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post Comment</button> --}}
            <x-primary-button type="submit">{{ __('Send Comment') }}</x-primary-button>

        </form>
    @endauth
</div>
