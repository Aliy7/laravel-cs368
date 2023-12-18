<?php

namespace App\Livewire\Comment;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Models\Notification;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

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
        $comment->created_at = now(); 
        $comment->updated_at = now();
        $comment->save();

        $this->comments = '';
        $this->reset('content');
        $this->getComments();
        $this->dispatch('commentCreated', content: $comment->content);

        // Display a success message when a comment is posted
        session()->flash('success', 'Comment posted successfully.');

      
        $postOwner = Post::findOrFail($this->post_id)->user;
        $commentOwner = Auth::user();
    
        if ($postOwner->id !== $commentOwner->id) {
            $this->makeNotification($commentOwner, $postOwner, $comment->id);
        }

    }


    public function getComments()
    {
        $this->comments = Comment::where('post_id', $this->post_id)->latest()->get();

        $this->dispatch('commentCreated');
    }

    private function makeNotification($commetOwner, $whoPosted, $commentId)
    {
   
        $notification = new Notification;
        $notification->user_id = $whoPosted->id; 
        $notification->comment_id = $commentId; 

        $notification->type = 'comment'; // or 'like'
        $notification->post_id = $this->post_id;
        $notification->is_read = false;
        $notification->save();

        try {
            // Mail::to($whoPosted->email)->queue(new EmailNotification($notification));
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
        
    }

    public function render()
    {
        return view('livewire.comments.post-comment');
    }
    protected $listeners = [
        'postCreated' => '$postCreated',
        'post-updated' => '$postUpdated',
        'createdNotication' => '$createdNot',
        'notificationCreated'=>'$notification',
        'createdNotication' => '$not'
    ];
}
