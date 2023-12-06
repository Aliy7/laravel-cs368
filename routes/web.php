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

//Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

// Route::get('/dashboard', [DashboardController::class, 'index']
// )->middleware(['auth', 'verified'])->name('dashboard.index');


Route::delete('/post/{id}', PostController::class. '@deletePost')->name('posts.deletePost');

Route::get('/posts/store', [CreatePost::class])->middleware('auth')->name('posts.create');
//Route::get('/store', [CreatePost::class])->middleware('auth')->name('store');
Route::get('/posts/render', [CreatePost::class])->middleware('auth')->name('posts.render');

Route::get('/show/mount', [ShowPost::class, 'usersgetPostsProperty'])->middleware('auth')->name('posts.mount');
Route::get('/shows/posts', [ShowPost::class, 'postsgetPostsProperty'])->name('postsgetPostsProperty');

Route::get('/posts/image', [PhotoUpload::class])->middleware('auth')->name('image.uploads');
//User to profile link 

//new PostComment component route

Route::get('/post/{post_id}/comments', [PostComment::class, 'post.comments'])->middleware('auth')->name('post-comment.postcomment');


Route::get('/dashboard', function () {
    // $posts = Post::all(); // Fetch all posts
    $posts = Post::where('user_id', Auth::id())->get(); // get only registered user
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/dashboard', function () {
    // Fetch all posts along with their comments and the users who made those comments
    $posts = Post::with(['comments.user', 'user'])->get();

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