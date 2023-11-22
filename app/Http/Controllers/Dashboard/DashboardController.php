<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Post;
class DashboardController extends Controller
{
    public function index()
{
    $posts = Post::all(); 
    // $user = Auth::user();
    // dd($user -> username);
    return view('dashboard', compact('posts')); 
}

// public function indexs(){
//     $categories = Category::all();
//     dd($categories);
//     return view('dashboard', compact('categories')); 
// }
}