<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorias extends Model
{
    //

    public function posts(){
        return $this->hasMany(Post::class,'id');
    }
}
