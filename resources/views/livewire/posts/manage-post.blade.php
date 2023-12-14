{{-- <div>

    <div class="relative">
        <!-- Trigger -->
        <button wire:click="toggleDropdown" class="ellipsis-button font-bold text-white">
            ⋮ <!-- Ellipsis icon -->
        </button>

        <!-- Dropdown -->
        <div style="display: {{ $isOpen ? 'block' : 'none' }}" class="absolute right-0 mt-2 bg-blue-500 text-white font-bold py-1 px-1 overflow-hidden">
            <ul class="text-white-800">
                <li><button onclick="confirmDeletion()" class="btn btn-danger">Delete</button></li>

                {{-- <button wire:click="deletePost" class="btn btn-danger">Delete</button> --}}

                {{-- <button wire:click="$dispatch('editPost', $postId)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                <!-- More options here -->
            </ul>
        </div>
    </div>

    <!-- Session Messages -->
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <script>
        function confirmDeletion() {
            if (confirm("Are you sure you want to delete this post?")) {
                @this.call('deletePost');
                console.log("post deleted")
            }
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                @this.call('closeDropdown');
            }
        }, true);
    </script>
 --}} 
 <div>
    <div class="relative">
        <!-- Trigger -->
        <button wire:click="toggleDropdown" class="ellipsis-button font-bold text-white">
            ⋮ <!-- Ellipsis icon -->
        </button>

        <!-- Dropdown -->
        <div style="display: {{ $isOpen ? 'block' : 'none' }}" class="absolute right-0 mt-2 bg-blue-500 text-white font-bold py-1 px-1 overflow-hidden">
            <ul class="text-white-800">
                <!-- Show Delete button for post owner or admin -->
                @if($post && auth()->check() && (auth()->user()->hasRole('admin') || $post->user_id == auth()->id()))
                <li>
                        {{-- <button wire:click="confirmDeletion" class="btn btn-danger">Delete</button> --}}
                        {{-- <li><button onclick="confirmDeletion()" class="btn btn-danger">Delete</button></li> --}}

                       <li><button onclick="confirmDeletion()" wire:click="deletePost" class="btn btn-danger">Delete</button> </li>

                    </li>
                @endif

                <!-- Existing Edit button, shown always -->
                <button wire:click="$dispatch('editPost', $post->id)" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</button>
                <!-- More options here -->
            </ul>
        </div>
    </div>

    <!-- Existing Session Messages -->
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    @if(session()->has('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
 </div>
    <!-- Existing Script for Deletion Confirmation -->
    <script>
        function confirmDeletion() {
            if (confirm("Are you sure you want to delete this post?")) {
                @this.call('deletePost');
                console.log("post deleted")
            }
        }

        document.addEventListener('click', function(event) {
            if (!event.target.closest('.relative')) {
                @this.call('closeDropdown');
            }
        }, true);
    </script> 

