<section class="px-6 py-8">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6"> 
  
<form action="{{ route('post.store') }}" method="POST">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title:</label>
        <input type="text" id="title" name="title" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
    </div>

    <div class="mb-6">
        <label for="content" class="block text-gray-700 text-sm font-bold mb-2">Content:</label>
        <textarea id="content" name="content" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline" required></textarea>
    </div>

    <div class="flex items-center justify-between">
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
            Create Post
        </button>
  
</form>
</div>
</section>


