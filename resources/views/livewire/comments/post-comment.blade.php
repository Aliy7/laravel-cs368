
<div>
    <!-- Display Comments -->
    <div class="comments mt-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
        <h4 class="font-semibold mb-2">Comments:</h4>
        @forelse ($comments as $comment)
            <div class="comment mb-2 p-2 border-b border-gray-300 dark:border-gray-700">
                <div class="flex justify-between items-center dark:text-gray-300">
                    <span>{{ $comment->content }}</span>
                    <a href="{{ route('profile.showProfile', $comment->user->id) }}" class="text-blue-500 hover:text-blue-700">
                        {{ $comment->user->username }}
                    </a>
                </div>
                @livewire('like-Unlike', ['type' => 'comment', 'modelId' => $post_id])
                {{-- @livewire('likes', ['type' => 'comment', 'modelId' => $comment->id]) --}}


            </div>
        @empty
            <p>No comments yet.</p>
        @endforelse
    </div>
    <!-- Add Comment Form -->
    @auth
    <form wire:submit="submitComment" class="mt-4">
        <textarea wire:model="content" placeholder="Add a comment..."
                  class="w-full h-24 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring focus:border-blue-300 text-gray-700"></textarea>
        <x-primary-button type="submit">{{ __('Send Comment') }}</x-primary-button>
    </form>
    @if(session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@endif

    @endauth
</div>

<script>
    window.addEventListener('comment-added', event => {
        document.querySelector('textarea').value = ''; // Clear the textarea
    });
</script>