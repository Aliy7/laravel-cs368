<?php

namespace App\Livewire\Likes;

use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use App\Models\Notification;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class LikeUnlike extends Component
{
    public $type;
    public $modelId;
    public $likesCount;
    public $dislikesCount;
    public $isLiked;
    public $isDisliked;

    public function mount($type, $modelId)
    {
        $this->type = $type;
        $this->modelId = $modelId;
        $this->likesCount = 0;
        $this->isDisliked = 0;
        $this->loadLikesData();
    }

    public function loadLikesData()
    {
        $model = $this->getModelInstance();

        if ($model) {
            // Counting likes
            $this->likesCount = $model->likes()->where('value', 1)->count();

            // Counting dislikes
            $this->dislikesCount = $model->likes()->where('value', -1)->count();

            // Checking if the current user has liked the model
            $this->isLiked = $model->likes()->where('user_id', auth()->id())->where('value', 1)->exists();

            // Checking if the current user has disliked the model
            $this->isDisliked = $model->likes()->where('user_id', auth()->id())->where('value', -1)->exists();
        } else {
            // Reset to default values if no model is found
            $this->likesCount = 0;
            $this->dislikesCount = 0;
            $this->isLiked = false;
            $this->isDisliked = false;
        }
    }

    public function toggleLike()
    {
        $this->handleToggle(1); // 1 for like
    }

    public function toggleDislike()
    {
        $this->handleToggle(-1); // -1 for dislike
    }
    private function handleToggle($value)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userId = auth()->id();
        $model = $this->getModelInstance();

        if ($model) {
            $existingLike = $model->likes()->where('user_id', $userId)->first();

            if ($existingLike) {
                if ($existingLike->value === $value) {
                    // User is "undoing" the like/dislike
                    $existingLike->delete();
                } else {
                    // User is changing from like to dislike or vice versa
                    $existingLike->value = $value;
                    $existingLike->save();
                }
            } else {
                // This is a new like/dislike action
                $like = new Like();
                $like->user_id = $userId;
                $like->value = $value;
                $model->likes()->save($like);
            }

            $this->loadLikesData();
            $this->makeLikeNotification($model, $userId);
        }
    }


    private function makeLikeNotification($model, $userId)
    {
        $notification = new Notification;
        $notification->user_id = $userId;
        $notification->type = 'like';

        // Determine if it's a like on a post or a comment
        if ($this->type === 'post') {
            $notification->post_id = $model->id;
            $notification->comment_id = null; // No comment ID for post likes
        } elseif ($this->type === 'comment') {
            $notification->comment_id = $model->id;
            $notification->post_id = null; // No post ID for comment likes
        }

        $notification->is_read = false;
        $notification->save();
        try {
            // Assuming you want to notify the owner of the post/comment
            $owner = $this->type === 'post' ? $model->user : $model->commenter;
            // Mail::to($owner->email)->queue(new EmailNotification($notification));
        } catch (\Exception $e) {
            Log::error('Error sending email: ' . $e->getMessage());
        }
    }
    private function getModelInstance()
    {
        return $this->type === 'post'
            ? Post::find($this->modelId)
            : Comment::find($this->modelId);
    }

    public function render()
    {
        return view('livewire.likes');
    }
}
