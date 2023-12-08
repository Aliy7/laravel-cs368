
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
                <button @click="confirmDeletion" class="btn btn-danger">Delete</button>
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
</script>
