<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;

class CreatePost extends Component
{
    public $title;
    public $content;
    
    public $post;
    protected $rules = [
        'title' => 'required|string|min:10',
        'content' => 'required|string|max:200',
    ];

    protected $messages = [
        'required' => 'This field is required',
        'min' => 'Value must be more than :min chars',
        'max' => 'Maximum value is 250 chars'
    ];


    public function render(Request $request)
    {
        return view('livewire.posts.create-post');
    }
   
    public function store()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            // Handle the unauthenticated user
            session()->flash('error', 'You must be logged in to create a post.');
            return redirect()->route('login');
        }
    
        // Continue with validation and post creation
        $this->validate();
    
        // Debug: Check Auth::id()
        logger('Authenticated user ID: ' . Auth::id());
    
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->user_id = Auth::id();
        $post->created_at = now();
        $post->updated_at = now();
        $post->save();
    
        // Check if post is created successfully
        if ($post) {
            session()->flash('success', 'Post created successfully.');
            return redirect()->route('dashboard');
        } else {
            session()->flash('error', 'Failed to create the post.');
            // return redirect()->back();
            return redirect()->route('dashboard'); // Using Livewire's redirect

        }
    }
    

   
    
    public function routes()
    {
        return [
            'store' => 'posts.create', 
            'render' => 'posts.render'
        ];
    }


}
