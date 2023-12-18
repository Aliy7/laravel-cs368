<?php
//namespace App\Http\Controllers;
namespace App\Http\Controllers\User;

namespace App\Http\Controllers\Comment;

namespace App\Livewire;
namespace App\Http\Controllers\Post;
use App\Models\User;


use App\Models\Post; 
use App\Mail\TestEmail;
use App\Livewire\PostTag;
use App\Livewire\LikeUnlike;
use App\Livewire\ImageUpload;
use App\Livewire\Post\PostEdit;
use App\Livewire\Post\ShowPost;
use App\Livewire\Post\CreatePost;
;
use App\Livewire\Post\DeletePost;
use App\Livewire\Quote\ShowQuote;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Comment\PostComment;
use Illuminate\Support\Facades\Route;
use App\Livewire\Profile\ProfileComponent;
use App\Http\Controllers\ProfileController;
use App\Livewire\Display\PostCommentDisplay;
use App\Livewire\Notification\Notifications;
use App\Http\Controllers\Post\PostController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/delete/{postId}', function ($postId) {
    return view('posts.manage-post', compact($postId)); 
})->middleware('auth')->name('posts.delete');

// Livewire route
Route::delete('/delete/{postId}', DeletePost::class)
     ->middleware('auth')
     ->name('posts.delete');


     Route::middleware(['auth'])->group(function () {
        // Other routes
    
        // Livewire route for editing a post
        Route::get('/posts/{id}/edit', PostEdit::class)->name('posts.edit');
    });   

Route::get('/posts/create', function () {
    return view('posts.create-post'); // 
})->middleware('auth')->name('posts.create');

// Standard route to a Blade view that includes the ShowPost Livewire component
Route::get('/posts/show', function () {
    return view('posts.show-post'); 
})->middleware('auth')->name('posts.show');




Route::get('/post/{post_id}/comments', [PostComment::class, 'post.comments'])->middleware('auth')->name('post-comment.postcomment');


Route::get('/dashboard', function () {
    $posts = Post::with(['comments.user', 'user'])->get();

    $verifiedUserId = Auth::id();
    $posts = $posts->map(function ($post) use ($verifiedUserId) {
        $post->isAuthUserPost = ($post->user_id === $verifiedUserId);
        return $post;
    });

    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/like-unlike/{type}/{id}', LikeUnlike::class)->name('like-unlike');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.showProfile');
    // Route::get('/user/{id}', [ProfileController::class, 'showPost'])->name('show.posts');
    Route::get('/user/{userId}', PostCommentDisplay::class)->name('user.posts');
    Route::get('/user/{userId}/posts', PostCommentDisplay::class)->name('user.posts');
    Route::get('/notifications', Notifications::class)->name('notifications');

Route::get('profile', ProfileComponent::class)->name('profile.update-profile');

});


Route::get('/quotes', ShowQuote::class)->name('show-quote');

Route::get('/tag/{postId}', PostTag::class)->name('post.tag');
Route::get('/posts/tag/{tag}', [PostController::class, 'showTag'])->name('posts.by.tag');


require __DIR__.'/auth.php';