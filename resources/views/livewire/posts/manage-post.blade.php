
<div class="relative" x-data="{ open: $wire.entangle('isOpen') }">
    <!-- Trigger -->
    <button @click="open = !open" class="ellipsis-button font-bold text-white">
        ⋮ <!-- Ellipsis icon -->
    </button>

    <!-- Dropdown -->
    <div x-show="open" @click.away="$wire.call('closeDropdown')" class="absolute right-0 mt-2 bg-blue-500 text-white font-bold py-1 px-1 overflow-hidden">
        <ul class="text-white-800">
            <div>
                <!-- Delete button with confirmation -->
              <li>  <button @click="confirmDeletion" class="btn btn-danger">Delete</button></li>
                {{-- <li><a href="#" wire:click="$dispatch('editPost', {{ $postId }})" class="block px-4 py-2 hover:bg-blue-500">Edit</a></li> --}}
                {{-- <li><button @click="$dispatch('editPost', { postId: {{ $postId }} })" class="btn btn-danger">Edit</button></li> --}}
                <button @click="isEditing = true" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded transition duration-300 ease-in-out">Edit</button>

            </div>
            <!-- More options here -->
        </ul>
    </div>
</div>

<!-- Session Messages -->
@if(session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
@elseif(session()->has('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

<script>

  
    function confirmDeletion() {
        let messageDanger = confirm("Are you sure you want to delete this post?");
        if (messageDanger) {
            @this.call('deletePost');
            console.log("post deleted")
        } else{
            console.log('you cannot delete')
        }
    }

    //hjhjasdfn
    document.addEventListener('alpine:init', () => {
        Alpine.data('dropdown', () => ({
            open: false,
            confirmDeletion() {
                if (confirm("Are you sure you want to delete this post?")) {
                    @this.call('deletePost');
                }
            },
            confirmEdit(postId) {
                // Dispatch the editPost event with the postId
                this.$dispatch('editPost', { postId });
                this.open = false; // Close the dropdown
            }
        }));
    });
</script>
