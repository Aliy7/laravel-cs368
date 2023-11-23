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
        $post->created_at = now()->toDateString();
        $post->updated_at= now()->toTimeString();

        $post->save();

        // $user = Auth::user();
        // dd($user);
        return redirect()->route('dashboard')->with('success', 'Post created successfully');
        //return redirect()->route('post.show', $post->id)->with('success', 'Post created successfully');
    }
    public function show($id ) {

        $post = Post::with('comments')->findOrFail($id);

        return view('posts.show', compact('post'));
    }
    
    public function index()
    {
        // Fetch only posts belonging to the authenticated user with their comments
        $posts = Post::with('comments')->where('user_id', Auth::id())->get();

        return view('dashboard', [
            'posts' => $posts,
        ]);
    }
    
    
    public function showLoggedUser()
{
    // Fetch only posts belonging to the authenticated user
    //$posts = Post::where('user_id', Auth::id())->get();
    $posts = Post::with('comments.user')->where('user_id', Auth::id())->get();
    return view('dashboard', compact('posts'));
        //return redirect()->route('dashboard')->with('success', 'Post created successfully');

}

}


