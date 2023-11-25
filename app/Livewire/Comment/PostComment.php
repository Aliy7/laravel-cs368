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
       $this->getComments();
    }

    // private function loadComments()
    // {
    //     $this->comments = Comment::where('post_id', $this->post_id)->latest()->get();
    // }

    public function submitComment()
    {
        $this->validate([
            'content' => 'required',
        ]);


        $comment = new Comment();
        $comment->content = $this ->content;
        $comment->post_id = $this->post_id;        
        $comment->user_id = Auth::id();
        $comment->created_at = now();
        $comment->updated_at = now();
        $comment->save();

        $this->reset('content');
        //$this->getComments();
        // $this->emit('commentAdded', $this->post_id); 

        if ($comment) {
            session()->flash('success', 'comment is sent successfully.');
            return redirect()->route('dashboard'); 

        } else {
            session()->flash('error', 'Cannot send comment.');
           // return redirect()->back();
           return redirect()->route('dashboard'); 

        }
    }

    public function getComments(){
        $this->comments = Comment::where('post_id', $this->post_id)->latest()->get();
    }

    public function render()
    {
        return view('livewire.comments.post-comment');
    }
}