{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
<h1> Hi are you still there</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    @include('posts.create-post')
    @include('posts.show')


{{-- <h1> Hi, are you still there?</h1>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Posts Section -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-lg font-semibold mb-4">Recent Posts</h3>
                    @foreach ($posts as $post)
                        <div class="mt-4">
                            <div class="text-lg font-semibold">{{ $post->title }}</div>
                            <div class="text-gray-600">{{ $post->content }}</div>
                            <div class="text-gray-600">{{ $post->post_time }}</div>
                            <div class="text-gray-600">{{ $post->user->last_name}}</div>
                            <div class="text-gray-600">{{ $post->user->user_id }}</div>


                        </div>
                    @endforeach
                </div>
            </div>  --}}
            <!-- End of Posts Section -->

            <!-- Creating post-->
{{-- 
            @foreach ($posts as $post)
           <div>
              <h3>{{ $post->title }}</h3>
                <p>{{ $post->content }}</p>
                  </div>
                 @endforeach --}}

                 {{-- @if (isset($categories) && $categories->count() > 0)
                 <div class="mb-6">
                     <label for="category_id" class="block text-gray-700 text-sm font-bold mb-2">Category:</label>
                     <select name="category_id" id="category_id" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
                         <option value="">Select a Category</option>
                         @foreach ($categories as $category)
                             <option value="{{ $category->id }}">{{ $category->name }}</option>
                         @endforeach
                     </select>
                 </div>
             @else
                 <p class="text-red-500">No categories available.</p>
             @endif --}}

       
                 <a href="/" > welcome</a>


            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
