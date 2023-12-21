<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class DeletePost extends Component
{
    public $post;

    public $showModal = false;
    public $postId;
    public $isOpen = false; 

    protected $listeners =[
        'post-updated' => '$post-updated',
        'postCreated' => '$postCreated'
,    ];

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
        $this->post = Post::find($this->postId);

        return view('livewire.posts.delete-post');
    }

    public function toggleDropdown()
    {
        $this->isOpen = !$this->isOpen;
        if ($this->isOpen) {
            $this->dispatch('dropdown-open');
        }
    }

    public function closeDropdown()
    {
        $this->isOpen = false;
    }

    public function deletePost()
    {
        $post = Post::find($this->postId);
        $user = Auth::user();

        if (!$post) {
            session()->flash('error', 'Post not found.');
            return $this;
        }

        // Admin can delete any post or user can delete their own post
        if ($user && ($user->hasRole('admin') || $post->user_id == $user->id)) {
            $post->delete();
           
            return $this;
        }
        $this->dispatch('postDeleted');
        session()->flash('error', 'Unauthorized action.');
    }
}
