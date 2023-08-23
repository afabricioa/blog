<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Category;

class PostController extends Controller{
    public function index(){
        return view('posts', [
            'posts'=> Post::latest()->filter(request(['search', 'author']))->get(),
            'categories' => Category::all()
        ]);
    }

    public function show(Post $post){
        // encontrar um post pelo caminho e retornar uma view.
        return view('post', [
            'post' => $post
        ]);
    }
}
