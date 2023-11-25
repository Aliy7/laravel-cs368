<?php

namespace App\Livewire\Post;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
class PhotoUpload extends Component
{

    public $image;
    public $post;

    protected $rules = [
        'photo' => 'required|image|max:2048'
    ];
    
    public function render()
    {
        return view('livewire.photo-upload');
    }

    public function mount($id){
        $this->post = Post::find($id);
    }

    public function uploads(){
        $this->validate();
        $image = $this->photo->storeAs();
        $this->post->featured_image = $image;
        $this->post->save();
        session()->flash("message", "Featured image successfully uploaded");
    }
}
