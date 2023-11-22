<?php
//namespace App\Http\Controllers;
namespace App\Http\Controllers\Post;
namespace App\Http\Controllers\User;

use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Models\Post; 
use App\Http\Controllers\Post\PostController;

use App\Http\Controllers\User\UserController;

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


Route::get('/showLoggedUser', [PostController::class, 'dashboard'])->middleware('auth');

Route::get('/post/create', [PostController::class, 'create'])->middleware('auth')->name('post.create');

//User to profile link 
Route::get('/profile/{id}', [UserController::class, 'showProfile'])->name('user.profile');

Route::post('/post', [PostController::class, 'store'])->middleware('auth')->name('post.store');

Route::get('/dashboard', function () {
    // $posts = Post::all(); // Fetch all posts
    $posts = Post::where('user_id', Auth::id())->get(); // get only registered user
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Route::prefix('admin')->group(function(){

//     Route::get('/dashboard', [DashboardController::class, 'index']);
// });

//show post on the screen

Route::get('/posts/{id}', [PostController::class, 'show'])->name('posts.show');


require __DIR__.'/auth.php';