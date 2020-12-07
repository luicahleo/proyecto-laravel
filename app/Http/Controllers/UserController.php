<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class UserController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    //Creamos un metodo que sera nueva pagina
    public function config(){
        //devuelve la vista que esta en la carpeta user
        return view('user.config');
    }

    //creamos metodo que reciba los datos de la pagina configuracion
    public function update(Request $request){

        //creamos el objeto user
        $user = \Auth::user();
        $id = $user->id;

        //validamos en funcion al request que nos llega
        $validate = $this->validate($request,[
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'nick' => 'required|string|max:255|unique:users,nick,'.$id, //unique:users,nick,'.$id ...significa nick unico en la tabla de usuarios pero con la excepcion de que coincida con el id que me llega
            'email' => 'required|string|email|max:255|unique:users,email,'.$id, //lo mismo de arriba
        ]);
        // Recoger datos del formulario
        $name = $request->input('name');
        $surname = $request->input('surname');
        $nick = $request->input('nick');
        $email = $request->input('email');

        //asignamos nuevos valores al objeto usuario
        $user->name = $name;
        $user->surname = $surname;
        $user->nick = $nick;
        $user->email = $email;

        //subir la imagen, el request esta vez trabaja con un file
        $image_path = $request->file('image_path');
        if ($image_path){
            //poner nombre unico
            $image_path_name = time().$image_path->getClientOriginalName();

            //guardar en la carpera storage (storage/app/users)
            Storage::disk('users')->put($image_path_name, File::get($image_path));

            //seteo el nombre de la imagen e el objeto
            $user->image = $image_path_name;
        }

        //Ejecutamos consulta y cambio en la BBDD
        $user->update();

        //redirigimos a una ruta
        return redirect()->route('config')
            ->with(['message'=>'Usuario actualizado correctamente']);
    }

    /*
     * Metodo para obtener imagen de Storage y luego mostrarlo en config y en el avatar
     * */
    public function getImage($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

}
