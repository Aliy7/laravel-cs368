<?php

namespace App\Livewire\Post;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;

class PostEdit extends Component
{
    public $postId;
    public $title = '';
    public $content = '';
    public $isEditing = false;

    protected $listeners = ['editPost' => 'edit'];

    public function mount($postId)
    {
        logger("Mounting with postId: $postId");

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
        $this->isEditing = true;
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

        $this->isEditing = false;
        $this->loadPost(); // Reload the post

        session()->flash('message', 'Post updated successfully.');
    }

    public function render()
    {
        return view('livewire.posts.post-edit');
    }
}