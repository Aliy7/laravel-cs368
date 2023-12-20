<?php

namespace App\Livewire\Display;

use App\Models\Post;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class PostCommentDisplay extends Component
{

    use WithPagination;

    public $userId;
    public $postPerPage = 4;

    public function mount($userId = null)
    {
        $this->userId = $userId ?? Auth::id();
    }

    public function render()
    {
        // Fetch posts for the specified user
        $userPosts = $this->displayUserPosts();

        // Fetch other posts that are not by the user
        $otherPosts = $this->displayOtherPosts();

        return view('livewire.display.post-link', compact('userPosts', 'otherPosts'))
            ->layout('layouts.app');
    }
    protected $queryString = [
        'userPage' => ['except' => 1],
        'otherPage' => ['except' => 1],
    ];

    private function displayUserPosts()
    {
        return Post::with(['user', 'comments.user'])
            ->where('user_id', $this->userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    public function allPosts()
    {
        return Post::with(['comments.user.profile', 'user.profile'])
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }

    private function displayOtherPosts()
    {
        return Post::with(['user', 'comments.user'])
            ->where('user_id', '!=', $this->userId)
            ->orderBy('created_at', 'desc')
            ->paginate(5);
    }
}
