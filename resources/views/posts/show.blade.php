{{-- resources/views/posts/show.blade.php --}}


{{-- @section('name')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>
    {{-- Add more details about the post --}}
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Posts Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                    @foreach ($posts as $post)
                        <div class="mt-4">
                            {{-- <div class="text-lg font-semibold">{{ $post->title }}</div> --}}
                           <a href="{{ route('user.profile', $post->user->id) }}">{{ $post->title }}</a>

                            <div class="text-gray-600">{{ $post->content }}</div>
                            <div class="text-gray-600">{{ $post->created_at }}</div>
                            <div class="text-gray-600">{{ $post->updated_at }}</div>
                            <a href="{{ route('user.profile', $post->user->id) }}">{{ $post->user->last_name }}</a>



                        </div>
                    @endforeach
                </div>
            </div> 
            <!-- End of Posts Section -->
