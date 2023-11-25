<?php
//namespace App\Http\Controllers;
namespace App\Http\Controllers\Post;
namespace App\Http\Controllers\User;

namespace App\Http\Controllers\Comment;

namespace App\Livewire;
use App\Http\Controllers\Admin\DashboardController;
use Illuminate\Support\Facades\Auth;


use App\Http\Controllers\ProfileController;
use App\Models\Post; 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Comment\CommentController;
use App\Livewire\Comment\PostComment;
use App\Livewire\Post\CreatePost;
use App\Livewire\Post\ShowPost;


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


//Index router get all users posts 
Route::get('/dashboard', [PostController::class, 'index'])->middleware('auth')->name('dashboard');

// Route::get('/store', CreatePost::class)->middleware('auth')->name('store');

//comment Controller route
Route::post('/comments', [CommentController::class, 'store'])->name('comments.store')->middleware('auth');

Route::get('/showLoggedUser', [PostController::class, 'dashboard'])->middleware('auth');



Route::get('/posts/store', [CreatePost::class])->middleware('auth')->name('posts.create');
//Route::get('/store', [CreatePost::class])->middleware('auth')->name('store');
Route::get('/posts/render', [CreatePost::class])->middleware('auth')->name('posts.render');

Route::get('/show/mount', [ShowPost::class, 'usersgetPostsProperty'])->middleware('auth')->name('posts.mount');
Route::get('/shows/posts', [ShowPost::class, 'postsgetPostsProperty'])->name('postsgetPostsProperty');

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


// Route::prefix('admin')->group(function(){

//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });

//show post on the screen

// Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


require __DIR__.'/auth.php';