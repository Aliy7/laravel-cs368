<?php
//namespace App\Http\Controllers;
namespace App\Http\Controllers\Post;
namespace App\Http\Controllers\User;

namespace App\Http\Controllers\Comment;

namespace App\Livewire;
use App\Models\Post; 


use App\Livewire\ImageUpload;
use App\Livewire\Post\ShowPost;
use App\Livewire\Post\CreatePost;
use App\Livewire\Post\PhotoUpload;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Comment\PostComment;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Comment\CommentController;
use App\Livewire\Post\ManagePost;

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
Route::get('/delete/{postId}', ManagePost::class)
     ->middleware('auth')
     ->name('posts.delete');


Route::middleware(['auth'])->group(function () {
        // Edit a post (GET request to show the edit form)
        Route::get('/posts/{id}/edit', [PostController::class, 'edit'])->name('posts.edit');
        
        // Update a post (PUT/PATCH request to update the post)
        Route::put('/posts/{id}', [PostController::class, 'update'])->name('posts.update');
    });     

Route::get('/posts/create', function () {
    return view('posts.create-post'); // 
})->middleware('auth')->name('posts.create');

// Standard route to a Blade view that includes the ShowPost Livewire component
Route::get('/posts/show', function () {
    return view('posts.show-post'); 
})->middleware('auth')->name('posts.show');



//Route::get('/posts/image', [PhotoUpload::class])->middleware('auth')->name('image.uploads');
//User to profile link 

//new PostComment component route

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



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    //Route::get('/profile/edit/{userId}', 'ProfileController@edit')->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/profile/{id}', [ProfileController::class, 'showProfile'])->name('profile.showProfile');

});
Route::get('/test-image', function () {
    return response()->file(storage_path('app/public/post_images/6570e603af5b9.jpg'));
});


// Route::prefix('admin')->group(function(){

//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });

//show post on the screen

// Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


require __DIR__.'/auth.php';