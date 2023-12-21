<x-app-layout>
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        @foreach ($posts as $post)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="text-blue-500">Post Title:<h3 class="text-lg font-semibold mb-4">{{ $post->title }}</h3></div>
                    Post Content<h3 class="text-lg font-semibold mb-4">{{ $post->content }}</h3>

                    <div class="flex flex-wrap gap-2">
                        @foreach ($post->tags as $tag)
                            <span class="px-3 py-1 bg-blue-200 text-blue-800 rounded-full text-sm font-medium">
                                Tags: {{ $tag->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach

        @if (count($posts) == 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100 text-center">
                    <p>No posts found for this tag.</p>
                </div>
            </div>
        @endif
    </div>
</div>
</x-app-layout>