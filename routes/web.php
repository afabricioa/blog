<?php

use App\Http\Controllers\PostController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use App\Models\Post;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [PostController::class, 'index'])->name('home');
Route::get('posts/{post}', [PostController::class, 'show']);

Route::get('categories/{category:slug}', function(Category $category) {
    return view('posts', [
        'posts'=> $category->posts
    ]);
});

Route::get('authors/{author:username}', function(User $author) {
    return view('posts', [
        'posts'=> $author->posts,
        'categories' => Category::all()
    ]);
});
