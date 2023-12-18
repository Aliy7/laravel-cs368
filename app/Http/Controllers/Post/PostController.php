<?php

namespace App\Http\Controllers\Post;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{

    public function create()
    {
        return ('post.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',

        ]);

        $post = new Post();
        $post->title = $request->title;
        $post->content = $request->content;
        $post->user_id = Auth::id(); // Set the user ID to the currently authenticated user
        $post->created_at = now()->toDateString();
        $post->updated_at = now()->toTimeString();

        $post->save();

        // $user = Auth::user();
        // dd($user);
        return redirect()->route('dashboard')->with('success', 'Post created successfully');
        //return redirect()->route('post.show', $post->id)->with('success', 'Post created successfully');
    }
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



 
    public function edit(Post $post)
    {
        // Check if the authenticated user owns the post
        if (auth()->user()->id !== $post->user_id) {
            return redirect()->route('posts.index')->with('error', 'Unauthorized action.');
        }

        return view('posts.post-edit', compact('post'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
        ]);

        return redirect()->route('posts.index')->with('message', 'Post updated successfully.');
    }
}
