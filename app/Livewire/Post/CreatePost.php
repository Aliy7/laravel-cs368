<?php

namespace App\Livewire\Post;

use Livewire\Component;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Validate;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CreatePost extends Component
{

    use WithFileUploads;
    public $title;
    public $content;
    public $image; // For the uploaded image
    public $image_url = null; // URL to be stored in the databas
    
    public $post;

    protected $listeners =[
        'commentCreated' => '$commentCreated',
        'qouteGenerated' => '$qouteGenerated'
    ];
    protected $rules = [
        'title' => 'required|string|min:10',
        'content' => 'required|string|max:3000',
        'image' => 'nullable|image|max:1024', 
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
        $post->image_url = $this->image_url; // This might be null if no image was uploaded
        $post->created_at = now();
        $post->updated_at = now();
       // logger('Before reset:', ['title' => $this->title, 'content' => $this->content]);
 
        if ($this->image) {
            $fileName = 'post_images/' . uniqid() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public', $fileName); // Stores in 'storage/app/public/post_images'
            $post->image_url = $fileName; // Store the file name in the database
        }
    
         $post->save();
         session()->flash('success', 'Post created successfully.');
         $this->reset(['title', 'content', 'image']);

        // logger('After reset:', ['title' => $this->title, 'content' => $this->content]);
         $this->dispatch('postCreated');
         $this->image_url = null; 
      
    }
        public function uploadImage()
        {
            $this->validate([
                'image' => 'nullable|image|max:1024', // Image validation
            ]);
    
            if ($this->image) {
                $this->image_url = $this->image->store('profile_pictures', 'public');
                session()->flash('message', 'Image uploaded successfully');
            }
        }
    public function resetPost(){
        $this-> title = '';
        $this ->content = '';
        $this->image_url=null;
        $this->image = null;
    }
    


    public function routes()
    {
        return [
            'store' => 'posts.create', 
            'render' => 'posts.render'
        ];
    }


}
