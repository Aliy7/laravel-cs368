
<div class="comments mt-4 bg-gray-100 dark:bg-gray-800 p-4 rounded-lg">
    @foreach ($post->comments as $comment)
        <div class="comment mb-2 p-2 border-b border-gray-300 dark:border-gray-700">
            <div class="comment-content dark:text-gray-300">
                {{ $comment->comment_content }}
            </div>
            <div class="comment-author text-right">
                <a href="{{ route('user.profile', $comment->user->id) }}" class="text-blue-500 hover:text-blue-700">
                    {{ $comment->user->name }}
                </a>
            </div>
        </div>
    @endforeach
</div>
