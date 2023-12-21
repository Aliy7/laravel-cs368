<?php

namespace App\Http\Controllers\Post;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function show($id)
    {

        $post = Post::with('comments.user')->findOrFail($id);

        return view('posts.show', compact('post'));
    }


    public function showTag($tagId)
    {
        $tag = Tag::findOrFail($tagId);
        $posts = $tag->posts()->with('tags')->get();

        return view('livewire.tags.post-tag', compact('posts'));
       
    }

}
