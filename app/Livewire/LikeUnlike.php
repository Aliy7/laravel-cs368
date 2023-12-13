<?php

namespace App\Livewire;
use App\Models\Like;
use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

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
        $this->likesCount=0;
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
                $existingLike->delete(); // Undoing the like/dislike
            } else {
                $existingLike->value = $value; // Change the value
                $existingLike->save(); // Explicitly save the updated record
            }
        } else {
            // Explicitly set 'user_id' when creating a new like
            $like = new Like();
            $like->user_id = $userId;
            $like->value = $value;
            $model->likes()->save($like);
        }

        $this->loadLikesData();
    }
}
// private function handleToggle($value)
// {
//     if (!auth()->check()) {
//         return redirect()->route('login');
//     }

//     $userId = auth()->id();
//     $model = $this->getModelInstance();

//     if ($model) {
//         $existingLike = $model->likes()->where('user_id', $userId)->first();

//         if ($existingLike) {
//             if ($existingLike->value === $value) {
//                 $existingLike->delete(); // Undoing the like/dislike
//             } else {
//                 $existingLike->value = $value; // Switching from like to dislike or vice versa
//                 $existingLike->save(); // Explicitly save the updated record
//             }
//         } else {
//             $model->likes()->create([
//                 'user_id' => $userId,
//                 'value' => $value
//             ]);
//         }

//         $this->loadLikesData();
//     }
// }

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