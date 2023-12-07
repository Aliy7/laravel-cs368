<?php

namespace App\Livewire\Post;
use Illuminate\Support\Str;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
class PhotoUpload extends Component
{
    use WithFileUploads;

    public $image; // Use this for the uploaded file

    protected $rules = [
        'image' => 'required|image|max:2048', // Use 'image' here
    ];

    public function render()
    {
        return view('livewire.posts.photo-uploads');
    }

    public function uploadImage()
    {
        $this->validate();

        if ($this->image) {
            $destinationPath = 'uploads/post_images';
            $fileName = time() . '_' . $this->image->getClientOriginalName();
            $this->image->move(public_path($destinationPath), $fileName);

            // Store the path in a session or pass it to the parent component
            session()->put('image_path', $destinationPath . '/' . $fileName);

            session()->flash("message", "Image uploaded successfully.");
        } else {
            session()->flash("error", "No image selected.");
        }
    }
}