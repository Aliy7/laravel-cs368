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
    public $image; 
    public $image_url = null; 

    
    public $post;

    protected $listeners = [
        'commentCreated' => '$commentCreated',
        'postDeleted' => '$postDeleted'
    ];
    protected $rules = [
        'title' => 'required|string|regex:/^[a-zA-Z0-9 ]+$/|max:50|min:10',
        'content' => 'required|string|regex:/^[a-zA-Z0-9 ]+$/|max:3000|min:10',
        
        'image' => 'nullable|image|max:1024',
    ];

    protected $messages = [
        'title.required' => 'You should write stuff to continue.',
        'title.min' => 'Minimum 10 characters: write something sensible :min characters.',
        'title.max' => 'You cannot enter more than 50 characters',
        'content.required' => 'You need to write some stuff.',
        'content.min' => 'Minimum 10 characters: write something sensible :min characters.',

        'content.max' => 'That is too much stuff :max characters.',
        'image.image' => 'It must me an image of jpeg and png format.',
        'image.max' => 'The image may not be larger than :max kilobytes.'
    ];


    public function render(Request $request)
    {
        return view('livewire.posts.create-post');
    }

    public function store()
    {
        // Check if the user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }
        $this->validate();
        $post = new Post();
        $post->title = $this->title;
        $post->content = $this->content;
        $post->user_id = Auth::id();
        $post->image_url = $this->image_url; 
        $post->created_at = now();
        $post->updated_at = now();

        if ($this->image) {
            $fileName = 'post_images/' . uniqid() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public', $fileName); 
            $post->image_url = $fileName; 
        }

        $post->save();
        session()->flash('success', 'Post created successfully.');
        $this->reset(['title', 'content', 'image']);

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
    public function resetPost()
    {
        $this->title = '';
        $this->content = '';
        $this->image_url = null;
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
