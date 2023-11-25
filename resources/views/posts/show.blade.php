{{-- 
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- All Posts Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                @foreach ($posts as $post)
                    <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                        <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                        <div class="text-gray-600 dark:text-gray-300">{{ $post->content }}</div>
                        <div class="text-gray-600 dark:text-gray-300">{{ $post->created_at->format('M d, Y') }}</div>
                        <div class="text-gray-600 dark:text-gray-300">{{ $post->updated_at->format('M d, Y') }}</div>
                        <a href="{{ route('profile.showProfile', $post->user->id) }}">{{ $post->user->last_name }}</a>

                        <!-- Comments Section -->
                        <div class="comments mt-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Comments:</h4>
                            @forelse ($post->comments as $comment)
                                <div class="comment mb-2 p-2 border-b border-gray-300 dark:border-gray-700">
                                    <div class="flex justify-between items-center dark:text-gray-300">
                                        <span>{{ $comment->comment_content }}</span>
                                        <a href="{{ route('profile.showProfile', $comment->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                            {{ $comment->user->username }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p>No comments yet.</p>
                            @endforelse

                            <!-- Add Comment Form -->
                            @auth
                                <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <textarea name="comment_content" placeholder="Add a comment..." class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"></textarea>
                                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post Comment</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div> --}}
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- All Posts Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                @foreach ($posts as $post)
                    <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                        <!-- User Avatar and Name -->
                        <div class="flex items-center mb-2">
                            @if($post->user->profile && $post->user->profile->avatar_url)
                                <!-- Avatar as a clickable link to the user's profile -->
                                <a href="{{ route('profile.showProfile', $post->user->id) }}">
                                    <img src="{{ $post->user->profile->avatar_url }}" alt="{{ $post->user->username }}'s avatar" class="rounded-full h-8 w-8 mr-2">
                                </a>
                            @endif
                            <span class="font-medium mr-2">Posted by:</span>
                            <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                {{ $post->user->username }}
                            </a>
                        </div>
                        
                        <!-- Post Title and Content -->
                        <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                        <div class="text-gray-600 dark:text-gray-300">{{ $post->content }}</div>
                        <div class="text-gray-600 dark:text-gray-300">{{ $post->created_at->format('M d, Y') }}</div>
                        <div class="text-gray-600 dark:text-gray-300">{{ $post->updated_at->format('M d, Y') }}</div>

                        <!-- Comments Section -->
                        <div class="comments mt-4 bg-white dark:bg-gray-800 p-4 rounded-lg shadow">
                            <h4 class="font-semibold mb-2">Comments:</h4>
                            @forelse ($post->comments as $comment)
                                <div class="comment mb-2 p-2 border-b border-gray-300 dark:border-gray-700">
                                    <div class="flex justify-between items-center dark:text-gray-300">
                                        <span>{{ $comment->comment_content }}</span>
                                        <a href="{{ route('profile.showProfile', $comment->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                            {{ $comment->user->username }}
                                        </a>
                                    </div>
                                </div>
                            @empty
                                <p>No comments yet.</p>
                            @endforelse

                            <!-- Add Comment Form -->
                            @auth
                                <form method="POST" action="{{ route('comments.store') }}" class="mt-4">
                                    @csrf
                                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                                    <textarea name="comment_content" placeholder="Add a comment..." class="w-full rounded border-gray-300 dark:border-gray-700 dark:bg-gray-700 dark:text-white"></textarea>
                                    <button type="submit" class="mt-2 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Post Comment</button>
                                </form>
                            @endauth
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
