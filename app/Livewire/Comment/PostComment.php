<?php

namespace App\Livewire\Comment;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class PostComment extends Component
{

    public $post_id;
    public $content;

    public $comments = []; 
    protected $rules = [
        'content' => 'required',
    ];
    public function render()
    {
        return view('livewire.comments.post-comment');
    }

    public function postComment()
    {
        $this->validate();

        Comment::create([
            'post_id' => $this->post_id,
            'user_id' => Auth::id(),
            'content' => $this->content,
        ]);

        $this->reset('content'); // Reset the comment field
        $this->emit('commentPosted'); // Emit an event to refresh the comments list

        session()->flash('message', 'Comment posted successfully');
    }

}
