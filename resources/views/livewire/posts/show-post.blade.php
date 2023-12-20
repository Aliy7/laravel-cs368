<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <!-- All Posts Section -->
        @livewire('quote.show-quote')

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
                              
                                <div class="flex justify-between items-center w-full">
                                    <!-- Left side: "Posted by" and username -->
                                    <div class="flex items-center grow">
                                        <span class="font-medium mr-2">Posted by:</span>
                                        <a href="{{ route('user.posts', $post->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                            {{ $post->user->username }}
                                        </a>
                                    </div>
                                    <div class="shrink-0">
                                        @livewire('post.delete-post', ['postId' => $post->id])
                                    </div>
                                </div>
                            </div>
                            <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                            <div class="text-gray-600 dark:text-gray-300">{{ $post->content }}</div>
                            <div class="text-gray-600 dark:text-gray-300">{{ $post->created_at->diffForHumans()}}</div>
                            @if($post->image_url)
                           <img src="{{ Storage::url($post->image_url) }}" alt="Post Image" class="post-image">
                            @endif

                            {{-- <h1 class="pt-4 italic"> 
                                Tags:
                                @foreach($post->tags as $tag )
                                {{$tag->name}}
                                @endforeach
                            </h1> --}}
                            <div class="flex flex-wrap gap-2">
                                @if($post->tags->isNotEmpty())
                                    Tags:
                                    @foreach ($post->tags as $tag)
                                        <a href="{{ route('posts.by.tag', $tag->id) }}" class="px-3 py-1 bg-blue-200 text-blue-800 rounded-full text-sm font-medium">
                                            #{{ $tag->name }}
                                        </a>
                                    @endforeach
                                @endif
                            </div>
                            
                            
                            
                             @livewire('post.post-edit', ['postId' => $post->id], key('post-edit-'.$post->id))
                           
                             @livewire('likes.like-Unlike', ['type' => 'post', 'modelId' => $post->id])

                               <!-- Include the Livewire post-comment component -->
                               
                               @livewire('comment.post-comment', ['post_id' => $post->id], key('post-comment-'.$post->id))

                               
                               {{-- @livewire('post-tag', ['postId' => $post->id], key('post-tags-'.$post->id)) --}}

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
                                
                                {{-- <img src="{{ $post->user->profile->avatar_url }}" alt="{{ $post->user->username }}'s avatar" class="rounded-full h-8 w-8 mr-2"> --}}
                            </a>
                             <!-- Display the uploaded image if available -->
                            @if($post->image_url)
                                <img src="{{ Storage::url($post->image_url) }}" alt="Post Image" style="max-width:300px; height:200px;">
                            @endif
                        @endif
                        <div class="flex justify-between items-center w-full">
                            <!-- Left side: "Posted by" and username -->
                            <div class="flex items-center grow">
                                <span class="font-medium mr-2">Posted by:</span>
                                <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-blue-500 hover:text-blue-700">
                                    {{ $post->user->username }}
                                </a>
                            </div>
                            <div class="shrink-0">
                                @livewire('post.delete-post', ['postId' => $post->id], key('manage-post-'.$post->id))
                        
                            </div>
                        </div>

                    </div>
             <div>
                <!-- Other content -->
            
                <!-- Display the test image -->
                {{-- <img src="{{ asset('storage/avatars/avatar.png') }}" alt="Test Image" style="max-width:100%; height:auto;"> --}}
                @if($post->image_url)
                {{-- Debugging line --}}
                
                <img src="{{ Storage::url($post->image_url) }}" alt="Post Image" class="post-image">
            @else
                No image available.
            @endif
            
            {{-- @livewire('counter') --}}
                <!-- More content -->
            </div>
            
                    <!-- Post Title and Content -->
                    <a href="{{ route('profile.showProfile', $post->user->id) }}" class="text-lg font-semibold">{{ $post->title }}</a>
                    <div class="text-gray-600 dark:text-gray-300">{{ $post->content }}</div>
                            <div class="text-gray-600 dark:text-gray-300">{{ $post->created_at->diffForHumans() }}</div>
                      <!-- Include the Livewire post-comment component -->
                      @livewire('comment.post-comment', ['post_id' => $post->id], key('post-comment-'.$post->id))
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
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            window.livewire.on('postCreated', function () {
               
                console.log('Post has been created.');
            });

            window.livewire.on('post-updated', function () {
                // Actions when a post is updated
                console.log('Post has been updated.');
            });

            window.livewire.on('postDeleted', function () {
                // Actions when a post is deleted
                console.log('Post has been deleted.');
            });

            window.livewire.on('postEdited', function () {
                // Actions when a post is edited
                console.log('Post has been edited.');
            });

            window.livewire.on('commentCreated', function () {
                // Actions when a comment is added
                console.log('A new comment has been created.');
            });
        });
    </script>
