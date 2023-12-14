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
    protected $listener = ['commentCreated' => '$getComments'];
    protected $listeners = ['postCreated' => '$refreshPosts',
                            'post-updated' => '$refresh',
                            'postDeleted' => '$deletePost',
                            'postEdited' => '$editPost',
                  ];


    public function allPosts()
    {
        return Post::with(['comments.user.profile', 'user.profile'])
                   ->orderBy('created_at', 'desc')
                   ->paginate(5);
    }

    public function userPosts()
    {
        return Post::with(['comments.user.profile', 'user.profile'])
                   ->where('user_id', Auth::id())
                   ->orderBy('created_at', 'desc')
                   ->paginate(5);
    }

    public function render()
    {
        return view('livewire.posts.show-post', [
            'allPosts' => $this->allPosts(),
            'userPosts' => $this->userPosts(),
        ]);
    }
    
}