<?php

namespace App\Livewire\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;

class ShowPost extends Component
{
    use WithPagination;

    protected $userPosts;
    protected $allPosts;
    protected $listener = ['commentAdded' => '$refresh'];
    protected $listeners = ['postCreated' => 'refreshPosts'];

    public function getPostsProperty()
    {
        return Post::with(['comments.user.profile', 'user.profile'])
                   ->orderBy('created_at', 'desc')
                   ->paginate(10);
    }

    public function getUserPostsProperty()
    {
        return Post::with(['comments.user.profile', 'user.profile'])
                   ->where('user_id', Auth::id())
                   ->orderBy('created_at', 'desc')
                   ->paginate(5);
    }

    public function render()
    {
        return view('livewire.posts.show-post', [
            'allPosts' => $this->getPostsProperty(),
            'userPosts' => $this->getUserPostsProperty(),
        ]);
    }
    
}