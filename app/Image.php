<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //Relacion One to Many, una imagen puede tener muchos comentarios
    public function comments(){
        return $this->hasMany('App\Comment');
    }

    //Relacion One to Many, una imagen puede tener muchos likes
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //Many to One, muchas imagenes tienen un solo usuario
    public function user(){
        return $this->belongsTo('App\User', 'user_id');
    }




}
