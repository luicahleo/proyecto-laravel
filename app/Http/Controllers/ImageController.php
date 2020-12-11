<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;
class ImageController extends Controller
{
    /**
     * Create a new controller instance.
     * Usamos este construct para que nadie entre a menos que este autenticado
     * restringimos a usuarios que no esten identificados
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Creamos nuevo metodo.
     * Para subir nuevas imagenes
     * @return image
     */
    public function create(){
        return view('image.create');
    }

    /**
     * Creamos nuevo metodo.
     * Para guardar imagenes
     * @return void
     */
    public function save(Request $request){

        //Validación
        $validate = $this->validate($request, [
            'description' => 'required',
            'image_path'  => 'required|image'
        ]);

        $image_path = $request->file('image_path');
        $description = $request->input('description');

        dump($image_path);
        dump($description);
        die();
        //return view('image.save');

        //Asignar valores nuevo objeto
        $image = new Image();
        $image->image_path = null;
        $image->description = $description;

        dump($image);
        die();




    }

}
