<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    //Creamos un metodo que sera nueva pagina
    public function config(){
        //devuelve la vista que esta en la carpeta user
        return view('user.config');
    }
}
