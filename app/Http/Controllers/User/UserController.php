<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showProfile($id)
    {
        $user = User::with('posts')->findOrFail($id);
        return view('profile', compact('user'));  // Updated from 'users.profile' to 'profile'
    }
    
}
