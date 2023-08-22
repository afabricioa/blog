<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $with = ['category', 'author']; //usa o Eager load nas queries sem precisar declarar na rota, 
    //evita query desnecessario no banco

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    protected $guarded = ['id']; //todas as propriedades sao fillable exceto as que estiverem aqui.
    // protected $fillable = ['title']; //propriedade necessario para usar o mass assignment pra inserir dados.
    //ignora as propriedades
}
