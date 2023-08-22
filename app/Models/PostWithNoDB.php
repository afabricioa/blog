<?php

namespace App\Models;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\File;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class PostWithNoDB{
    
    public $title;
    public $excerpt;
    public $date;
    public $body;
    public $slug;

    public function __construct($title, $excerpt, $date, $body, $slug){
        $this->title = $title;
        $this->excerpt = $excerpt;
        $this->date = $date;
        $this->body = $body;
        $this->slug = $slug;
    }

    public static function all(){
        return collect(File::files(resource_path("posts")))
        ->map(function($file) {
            return YamlFrontMatter::parseFile($file);
        })
        ->map(function($document) {
            return new Post(
                $document->title,
                $document->excerpt,
                $document->date,
                $document->body(),
                $document->slug
            );
        });

        // return array_map(fn($file) => $file->getContents(), $files); 
        // arrow function para diminuir a codificacao
    }

    public static function find($slug){
        // if(!file_exists($path = resource_path("posts/{$slug}.html"))){
            //dd('file does not exist');
            //ddd('file does not exist');
            //abort(404);
            // throw new ModelNotFoundException();
        // }

        //faz um cache para evitar usar o metodo file_get_contents toda vez que for feita uma solicitação
        //cache é guardada por 20 minutos nesse caso
        // $post = cache()->remember("post.{$slug}", now() -> addMinutes(20), function () use ($path) { 
        //     var_dump('file_get_contents'); 
        //     return file_get_contents($path);
        // });

        //isso substitui o de cima.
        // return cache()->remember("posts.{$slug}", now() -> addMinutes(20, fn() => file_get_contents($path));
        return static::all()->firstWhere('slug', $slug);
    }
}