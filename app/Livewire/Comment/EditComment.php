<?php

namespace App\Livewire\Comment;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class EditComment extends Component
{
    public $commentId;
    public $content = '';
    public $isEditing = false;
    public $tryEditing = false;

    public function mount($commentId)
    {
        $this->commentId = $commentId;
        $this->loadComment();
    }

    private function loadComment()
    {
        $comment = Comment::find($this->commentId);

        if (!$comment) {
            session()->flash('error', 'Comment not found.');
            return;
        }

        if (Auth::id() !== $comment->user_id) {
            session()->flash('error', 'Unauthorized action.');
            return;
        }

        $this->content = $comment->content;
    }
    // public function edit()
    // {
    //     $user = Auth::user();
    //     $comment = Comment::find($this->commentId);
    
    //     if (!$comment) {
    //         session()->flash('error', 'Comment not found.');
    //         $this->resetEditing();
    //         return;
    //     }
    
    //     $this->tryEditing = true;
    
    //     // Admins can edit all comments
    //     if ($user->hasRole('admin')) {
    //         $this->isEditing = true;
    //     } 
    //     // Moderators can edit all comments except those authored by admins
    //     elseif ($user->hasRole('mod') && !$comment->user->hasRole('admin')) {
    //         $this->isEditing = true;
    //     } 
    //     // Users can edit their own comments
    //     elseif ($comment->user_id == $user->id) {
    //         $this->isEditing = true;
    //     } 
    //     // If none of the above, deny permission
    //     else {
    //         session()->flash('error', 'Unauthorized action.');
    //         $this->resetEditing();
    //         $this->dispatch('commentEdited');
    //     }
    // }
    public function edit()
{
    $user = Auth::user();
    $comment = Comment::find($this->commentId);

    if (!$comment) {
        session()->flash('error', 'Comment not found.');
        $this->resetEditing();
        return;
    }

    $this->tryEditing = true;

    // Admins can edit all comments
    if ($user->hasRole('admin')) {
        $this->isEditing = true;
        $this->content = $comment->content;
    } 
    // Moderators can edit all comments except those authored by admins
    elseif ($user->hasRole('mod') && !$comment->user->hasRole('admin')) {
        $this->isEditing = true;
        $this->content = $comment->content; // Ensure moderators see the content
    } 
    // Users can edit their own comments
    elseif ($comment->user_id == $user->id) {
        $this->isEditing = true;
        $this->content = $comment->content;
    } 
    // If none of the above, deny permission
    else {
        session()->flash('error', 'Unauthorized action.');
        $this->resetEditing();
    }
}

    private function resetEditing()
    {
        $this->isEditing = false;
        $this->content = '';
    }

    public function updateComment()
    {
        $this->validate([
            'content' => 'required|string|max:3000|min:10',
        ]);

        $comment = Comment::find($this->commentId);
        if (!$comment) {
            session()->flash('error', 'Comment not found.');
            return;
        }

        $comment->content = $this->content;
        $comment->save();

        

        $this->dispatch('comment-updated',  $this->commentId);
        $this->isEditing = false;

    }

    public function cancelEdit()
    {
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.comments.edit-comment');
    }
}
