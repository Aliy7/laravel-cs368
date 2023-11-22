<?php

namespace App\Http\Controllers\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class PostController extends Controller
{
    
    public function create(){
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
        $post->post_date = now()->toDateString();
        $post->post_time = now()->toTimeString();

        $post->save();

        $user = Auth::user();
        dd($user);
        return redirect()->route('dashboard')->with('success', 'Post created successfully');
        //return redirect()->route('post.show', $post->id)->with('success', 'Post created successfully');
    }
    // public function show(Post $post) {
    //     return view('post.show', compact('post'));
    // }
    
    
}

