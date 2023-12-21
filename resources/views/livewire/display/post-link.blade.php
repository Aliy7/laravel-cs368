<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <!-- User's Posts Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-4">My Posts</h3>
                @forelse ($userPosts as $post)
                    <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mt-4">
                        <h4 class="text-lg font-semibold">{{ $post->title }}</h4>
                        <p>{{ $post->content }}</p>
                        <span class="font-medium mr-2">Posted by:</span>
                        <a href="{{ route('user.posts', $post->user->username) }}" class="text-blue-500 hover:text-blue-700">
                            {{ $post->user->username }}
                        </a>
                        <p class="text-gray-600">Posted {{ $post->created_at->diffForHumans() }}</p>

                       <!-- Display User's Comments on This Post -->
                       @foreach ($post->comments as $comment)
                       @if ($comment->user_id == $post->user_id)
                           <div class="mt-4">
                               <h5 class="font-medium">My Comment:</h5>
                               <div class="bg-white dark:bg-gray-800 p-2 mt-2 rounded-md flex justify-between items-center">
                                   <div>
                                       {{ $comment->content }}
                                   </div>
                                   <div class="text-blue-500">
                                       Commented on {{ $post->user->username }}'s post
                                   </div>
                               </div>
                           </div>
                       @endif
                   @endforeach
                   
                    </div>
                @empty
                    <p>No posts available.</p>
                @endforelse
                {{ $userPosts->links() }}
            </div>
        </div>
    </div>
</div>


{{-- 
            <!-- Other Users' Posts Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Other Users' Posts</h3>
                    @forelse ($otherPosts as $post)
                        <div class="bg-gray-100 dark:bg-gray-700 p-4 rounded-lg mt-4">
                            <h4 class="text-lg font-semibold">{{ $post->title }}</h4>
                            <p>{{ $post->content }}</p>
                            <p class="text-gray-600">Posted by {{ $post->user->name }} - {{ $post->created_at->diffForHumans() }}</p>

                            <div class="mt-4">
                                <h5 class="font-medium">Comments:</h5>
                                @foreach ($post->comments as $comment)
                                    <div class="bg-white dark:bg-gray-800 p-2 mt-2 rounded-md">
                                        {{ $comment->content }} - <strong>{{ $comment->user->name }}</strong>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @empty
                        <p>No other posts available.</p>
                    @endforelse
                    {{ $otherPosts->links() }}
                </div> --}}
            {{-- </div> --}}

        </div>
    </div>
