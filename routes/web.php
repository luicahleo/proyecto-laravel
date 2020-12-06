<?php

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


//importamos Image para probar el ORM
use App\Image;

Route::get('/', function () {

    $images = Image::all();

    //probamos con foreach, pero saca muchas cosas que no necesitamos por ahora
    /*foreach ($images as $image){
        var_dump($image);
        echo '<br/>';
    }*/
    foreach ($images as $image){
        //aqui mostraremos solo lo que queremos
        echo $image->image_path.'<br/>';
        echo $image->description.'<br/>';
        echo $image->user->name.' '.$image->user->surname;
        echo '<hr>';
    }



    die();




    return view('/');
});
