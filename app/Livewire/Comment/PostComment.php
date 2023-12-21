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
    protected $rules = [
        'content' => 'required|string|regex:/^(?=.*[a-zA-Z])[a-zA-Z0-9 .,"\']+$/|max:1000|min:10',
    ];
    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
            
    }

    public function submitComment()
    {
        $this->validate();
        $comments = new Comment();
        $comments->content = $this->content;
        $comments->post_id = $this->post_id;
        $comments->user_id = Auth::id();
        $comments->created_at = now(); 
        $comments->updated_at = now();
        $comments->save();

        $this->comments = '';
        $this->reset('content');
        $this->getComments();
        $this->dispatch('commentCreated', content: $comments->content);

        // Display a success message when a comment is posted
        session()->flash('success', 'Comment posted successfully.');

      
        $postOwner = Post::findOrFail($this->post_id)->user;
        $commentOwner = Auth::user();
    
        if ($postOwner->id !== $commentOwner->id) {
            $this->makeNotification($commentOwner, $postOwner, $comments->id);
        }

    }


    public function getComments()
    {
        $this->comments = Comment::with('user')
                         ->where('post_id', $this->post_id)
                         ->orderBy('created_at', 'asc') // or any other column
                         ->get();

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
        'createdNotication' => '$not',
        // 'commentEdited' => 'handleCommentEdited',
        'comment-updated' =>'$comment-updated',
      
    ];

    //Have a look at event issues tomorrow
    public function handleCommentEdited($commentId)
{

}

}
