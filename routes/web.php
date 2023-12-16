<?php
//namespace App\Http\Controllers;
namespace App\Http\Controllers\Post;
namespace App\Http\Controllers\User;

namespace App\Http\Controllers\Comment;

namespace App\Livewire;
use App\Models\User;


use App\Models\Post; 
use App\Mail\TestEmail;
use App\Livewire\Quote\ShowQuote;
use App\Livewire\LikeUnlike;
use App\Livewire\ImageUpload;
use App\Livewire\Post\PostEdit;
use App\Livewire\Post\ShowPost;
use App\Livewire\Post\CreatePost;
use App\Livewire\Post\ManagePost;
use App\Livewire\Post\PhotoUpload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Livewire\Comment\PostComment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Livewire\Display\PostCommentDisplay;
use App\Livewire\Notification\Notifications;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\QuoteGeneratorController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Comment\CommentController;


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

    dd($postId);
    return view('posts.manage-post', compact($postId)); 
})->middleware('auth')->name('posts.delete');

// Livewire route
Route::delete('/delete/{postId}', ManagePost::class)
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

    $authenticatedUserId = Auth::id();
    $posts = $posts->map(function ($post) use ($authenticatedUserId) {
        $post->isAuthUserPost = ($post->user_id === $authenticatedUserId);
        return $post;
    });

    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');




Route::get('/like-unlike/{type}/{id}', LikeUnlike::class)->name('like-unlike');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::get('/profile/edit/{userId}', 'ProfileController@edit')->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.showProfile');
    // Route::get('/user/{id}', [ProfileController::class, 'showPost'])->name('show.posts');
    Route::get('/user/{userId}', PostCommentDisplay::class)->name('user.posts');
    Route::get('/user/{userId}/posts', PostCommentDisplay::class)->name('user.posts');
    Route::get('/notifications', Notifications::class)->name('notifications');



});


// Route::get('/quotes', [QuoteGeneratorController::class, 'showQuotes'])->name('quotes.show');
Route::get('/quotes', ShowQuote::class)->name('show-quote');


require __DIR__.'/auth.php';