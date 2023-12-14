<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostEdit extends Component
{
    public $postId;
    public $title ;
    public $content = '';
    public $isEditing = false;
    public $attemptedEdit = false; 
    protected $listeners = 
    [
    'commentCreated' => '$comment-Created',
    'postDeleted' => '$postDeleted'];

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
        $post = Post::find($this->postId);
        $this->attemptedEdit = true; // Set to true when edit is attempted

        if (!$post || Auth::id() !== $post->user_id) {
            // Unauthorized user, do not enable editing
            session()->flash('error', 'Unauthorized action.');
            $this->resetEditing(); // Reset editing state
        } else {
            // Authorized user, enable editing
            $this->isEditing = true;
            $this->title = $post->title;
            $this->content = $post->content;
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
    public function refreshList() {
        $this->postId = Post::all(); // Or however you fetch your posts
    }
    

    public function render(){
        return view('livewire.posts.post-edit', [
            'postId' => Post::all() // Fetch all posts

        ]);

    }
 
    public function cancelEdit()
{
    $this->isEditing = false; // Revert editing mode without saving
}
public function refreshPostData() {
    $post = Post::find($this->postId);
    if ($post) {
      
        $this->title = $post->title;
        $this->content = $post->content;
    }
}

}