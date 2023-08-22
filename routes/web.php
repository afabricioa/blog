<?php

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

Route::get('/', function () {
    // ddd($posts[0]->getContents()); //serve para debugar as informacoes

    //.map
    // $posts = array_map(function ($file) {
    //     $document = YamlFrontMatter::parseFile($file);

    //     return new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );
    // }, $files);

    // .foreach
    // foreach($files as $file){
    //     $document = YamlFrontMatter::parseFile($file);
        
    //     $posts[] = new Post(
    //         $document->title,
    //         $document->excerpt,
    //         $document->date,
    //         $document->body(),
    //         $document->slug
    //     );
    // }

    return view('posts', [
        'posts'=> Post::latest()->with('category', 'author')->get()
    ]);
});


Route::get('posts/{post}', function ($id) {
    // encontrar um post pelo caminho e retornar uma view.
    return view('post', [
        'post' => Post::findOrFail($id)
    ]);
});

Route::get('categories/{category:slug}', function(Category $category) {
    return view('posts', [
        'posts'=> $category->posts
    ]);
});

Route::get('authors/{author}', function(User $author) {
    return view('posts', [
        'posts'=> $author->posts
    ]);
});