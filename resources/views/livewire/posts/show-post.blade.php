<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- All Posts Section -->
        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900 dark:text-gray-100">
                <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                @if($allPosts && $allPosts->count() > 0)
                    @foreach ($allPosts as $post)
                        <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                            <div class="flex items-center mb-2">
                                @if($post->user->profile && $post->user->profile->avatar_url)
                                    <a href="{{ route('profile.showProfile', $post->user->id) }}">
                                        <img src="{{ $post->user->profile->avatar_url }}" alt="{{ $post->user->username }}'s avatar" class="rounded-full h-8 w-8 mr-2">
                                    </a>
                                @endif
                                <span class="font-medium mr-2">Posted by:</span>
                                <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $post->user->username }}
                                </a>
                            </div>
                            <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                            <div class="text-gray-600 dark:text-gray-300">{{ $post->content }}</div>
                            <div class="text-gray-600 dark:text-gray-300">{{ $post->created_at->diffForHumans()}}</div>
                            @if($post->image_url)
                           <img src="{{ Storage::url($post->image_url) }}" alt="Post Image" class="post-image">
                            @endif

                               <!-- Include the Livewire post-comment component -->
                               @livewire('comment.post-comment', ['post_id' => $post->id])
                        </div>
                    @endforeach
                    {{ $allPosts->links() }}
                @else
                    <p>No posts available.</p>
                @endif
            </div>
        </div>
        
       <!-- User Posts Section -->
<div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 text-gray-900 dark:text-gray-100">
        <h3 class="text-lg font-semibold mb-4">Your Posts</h3>
        @if($userPosts && $userPosts->count() > 0)
            @foreach ($userPosts as $post)
                <div class="mt-4 bg-gray-100 dark:bg-gray-700 p-4 rounded-lg">
                    <!-- User Avatar and Name -->
                    <div class="flex items-center mb-2">
                        @if($post->user->profile && $post->user->profile->avatar_url)
                            <a href="{{ route('profile.showProfile', $post->user->id) }}">
                                
                                <img src="{{ $post->user->profile->avatar_url }}" alt="{{ $post->user->username }}'s avatar" class="rounded-full h-8 w-8 mr-2">
                            </a>
                             <!-- Display the uploaded image if available -->
                            @if($post->image_url)
                                <img src="{{ Storage::url($post->image_url) }}" alt="Post Image" style="max-width:300px; height:200px;">
                            @endif
                        @endif
                        <span class="font-medium mr-2">Posted by:</span>
                        <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-blue-500 hover:text-blue-700">
                            {{ $post->user->username }}
                        </a>
                    </div>


             <div>
                <!-- Other content -->
            
                <!-- Display the test image -->
                {{-- <img src="{{ asset('storage/avatars/avatar.png') }}" alt="Test Image" style="max-width:100%; height:auto;"> --}}
                @if($post->image_url)
                <img src="{{ Storage::url($post->image_url) }}" alt="Post Image" class="post-image">
            @endif
            
                <!-- More content -->
            </div>
            
                    <!-- Post Title and Content -->
                    <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                    <div class="text-gray-600 dark:text-gray-300">{{ $post->content }}</div>
                            <div class="text-gray-600 dark:text-gray-300">{{ $post->created_at->diffForHumans() }}</div>
                      <!-- Include the Livewire post-comment component -->
                      @livewire('comment.post-comment', ['post_id' => $post->id])
                    </div>
            @endforeach
            {{ $userPosts->links() }} <!-- Pagination links -->
        @else
            <p>You have not posted anything yet.</p>
        @endif
    </div>
</div>

    </div>
</div>
