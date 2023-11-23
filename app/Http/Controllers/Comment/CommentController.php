<?php

namespace App\Http\Controllers\Comment;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comment;
class CommentController extends Controller
{
   
    public function store(Request $request)
    {
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'comment_content' => 'required',
            // other validation rules as necessary
        ]);
    
        $comment = new Comment();
        $comment->post_id = $request->post_id;
        $comment->user_id = Auth::id(); // Set the user ID to the currently authenticated user
        $comment->comment_content = $request->comment_content;
        $comment->save();
    
        return redirect()->route('dashboard')->with('success', 'Comment posted successfully');
    }
    
    public function create(){
        return('comment.create');
    }

    public function index(){

        $comment = Comment::all();
        dd($comment);
        return view('comment', compact('post'));

        
    }
    
}
