<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostEdit extends Component
{
    public $postId;
    public $title;
    public $content = '';
    public $isEditing = false;
    public $tryEditing = false;
    protected $listeners =
    [
        'commentCreated' => '$comment-Created',
        'postDeleted' => '$postDeleted'
    ];

    public function mount($postId)
    {

        $this->postId = $postId;
        $this->loadPost();
    }

    private function loadPost()
    {

        $post = Post::find($this->postId);

        if (!$post || Auth::id() !== $post->user_id) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        $this->title = $post->title;
        $this->content = $post->content;
    }



    public function edit()
    {
        $user = Auth::user();
        $post = Post::find($this->postId);
        $this->tryEditing = true; // Set to true when edit is attempted

        if($user && ($user->hasRole('admin') || $post->user_id == $user->id)){
            $this->isEditing = true;
            $this->title = $post->title;
            $this->content = $post->content;
        } else {
            if (!$post) {
                session()->flash('error', 'Post not found.');
            } else {
                session()->flash('error', 'Unauthorized action.');
            }
            $this->resetEditing(); 
            $this->dispatch('postEdited');
        }
    }

    private function resetEditing()
    {
        $this->isEditing = false;
        $this->title = '';
        $this->content = '';
    }
    public function updatePost()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post = Post::find($this->postId);
        $post->update([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->dispatch('post-updated', $this->postId);
        $this->isEditing = false;
    }
    public function refreshList()
    {
        $this->postId = Post::all();
    }

    public function render()
    
    {
        $post = Post::find($this->postId);

        return view('livewire.posts.post-edit', [
            'postId' => Post::all() 

        ]);
    }

    public function cancelEdit()
    {
        $this->isEditing = false; 
    }
    public function refreshPostData()
    {
        $post = Post::find($this->postId);
        if ($post) {

            $this->title = $post->title;
            $this->content = $post->content;
        }
    }
}
