{{-- <!-- create-comment.blade.php -->
<form method="POST" action="{{ route('comments.store') }}" class="mt-4">
    @csrf
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <textarea name="comment_content" placeholder="Add a comment..." 
    class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white">
</textarea>
    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post Comment</button>
</form> --}}
