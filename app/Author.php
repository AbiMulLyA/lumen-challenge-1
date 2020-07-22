<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $table = 'authors';

    public function post(){
        return $this->hasMany('App\Post');
    }

    public function comment(){
        return $this->hasMany('App\Comment');
    }
}
