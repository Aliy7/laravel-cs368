<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ManagePost extends Component
{


    public $post;

    public $showModal = false;
    public $postId;
    public $isOpen = false; // For the ellipsis menu

    protected $listeners = [   
        'delete' => '$postDeleted',
   
    ];
    public function openModal($postId)
    {
        $this->postId = $postId;
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
    }
    public function confirmDeletion()
    {
        if ($this->postId) {
            $this->deletePost();
            $this->dispatch('confirmDeletion', $this->postId);
            $this->closeModal();

        }
    }
    public function render()
    {
        return view('livewire.posts.manage-post');
    }
    // Method to toggle the dropdown visibility
    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->dispatch('dropdown-open');
        }
    }

    // Method to close the dropdown
    public function closeDropdown()
    {
        $this->isOpen = false;
    }
    public function deletePost()
    {
        $post = Post::find($this->postId);
        Log::info("Confirm Deletion called for post ID: " . $this->postId);
    
        if (!$post) {
            session()->flash('error', 'Post not found.');
            return;
        }
    
        if (Auth::check() && $post->user_id == Auth::id()) {
            $post->delete();

            session()->flash('message', 'Post deleted successfully.');
    
            // Update the component's state
            $this->post = Post::all(); // Assuming $this->posts holds the collection of posts
    
            // Optionally emit an event if other components need to react to the deletion
        } else {
            session()->flash('error', 'Unauthorized action.');
        }
        $this->dispatch('postDeleted');

        $this->redirect("/dashboard");
    }
    

    
}