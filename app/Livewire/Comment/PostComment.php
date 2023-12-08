<?php

namespace App\Livewire\Comment;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostComment extends Component
{
    public $post_id;
    public $content;
    public $comments;

    public function mount($post_id)
    {
        $this->post_id = $post_id;
        $this->getComments();
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'content' => 'required',
        ]);
    }

    public function submitComment()
    {
        $this->validate([
            'content' => 'required',
        ]);
    
        $comment = new Comment();
        $comment->content = $this->content;
        $comment->post_id = $this->post_id;
        $comment->user_id = Auth::id();
        $comment->created_at = now(); // Manually setting created_at
        $comment->updated_at = now(); // Manually setting updated_at
        $comment->save();

       $this->comments='';
       $this->reset('content');
       $this->getComments();
       $this->dispatch('commentis created');
    
        // Display a success message when a comment is posted
        session()->flash('success', 'Comment posted successfully.');
    }
    

    public function getComments()
    {
        $this->comments = Comment::where('post_id', $this->post_id)->latest()->get();
    }

    public function render()
    {
        return view('livewire.comments.post-comment');
    }
    protected $listeners = ['refreshComponent' => '$refresh'];
   

}