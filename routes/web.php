<?php
//namespace App\Http\Controllers;
namespace App\Http\Controllers\Post;

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Models\Post; 
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

//Route::get('/post/{id}', [PostController::class, 'show'])->name('post.show');

// Route::get('/dashboard', [DashboardController::class, 'index']
// )->middleware(['auth', 'verified'])->name('dashboard.index');


Route::get('/post/create', [PostController::class, 'create'])->middleware('auth')->name('post.create');

// ...

Route::post('/post', [PostController::class, 'store'])->middleware('auth')->name('post.store');

Route::get('/dashboard', function () {
    $posts = Post::all(); // Fetch all posts
    return view('dashboard', compact('posts'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->group(function(){

    Route::get('/dashboard', [DashboardController::class, 'index']);
});


require __DIR__.'/auth.php';