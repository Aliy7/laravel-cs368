<?php

namespace App\Livewire\Post;
use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowPost extends Component
{
    use WithPagination;
    public $tags = []; 
    public $allTags;
    public $selectedTag = null;
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

   
    // #[On('commentEdited')]
    // public function updatePostEdited($content){

    // }
    public function userPosts()
    {
        return Post::with(['comments.user.profile', 'user.profile'])
                   ->where('user_id', Auth::id())
                   ->orderBy('created_at', 'desc')
                   ->paginate(5);
    }
    
    public function selectedTag($tagId)
    {
        $this->selectedTag = $tagId;
        $this->resetPage(); // Reset pagination when changing tags
    }
        
    public function render()
    {
        return view('livewire.posts.show-post', [
            'allPosts' => $this->allPosts(),
            'userPosts' => $this->userPosts(),
        ]);
    }
    
    public function mount(){
        $this->allTags = Tag::all();
    }
}