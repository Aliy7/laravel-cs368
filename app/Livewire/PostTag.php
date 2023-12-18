<?php

namespace App\Livewire;

use App\Models\Tag;
use App\Models\Post;
use Livewire\Component;

use function Livewire\Volt\layout;

class PostTag extends Component
{
    public $post;

    public function mount($postId)
    {
        $this->post = Post::with('tags')->find($postId);
    }

    public function showTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $posts = $tag->posts()->with('tags')->get();

        return view('livewire.tags.post-tag', compact('posts'));

    }

    public function render()
    {
        
        return view('livewire.tags.post-tag', ['post' => $this->post])
        ->layout('layouts.app');
    }
}