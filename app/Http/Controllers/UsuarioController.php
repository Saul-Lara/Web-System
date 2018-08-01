<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;

use sysVentas\User;      //Se agrega el modelo a utilizar
use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use sysVentas\Http\Requests\UsuarioFormRequest;   //Validacion del formulario
use DB; //Clase de laravel

class UsuarioController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $usuarios = DB::table('users')->where('name', 'LIKE', '%'.$query.'%')
                                          ->orderBy('id', 'desc')
                                          ->paginate(7);

            return view('acceso.usuarios.index',["usuarios" => $usuarios, "searchText" => $query ]);  //Vista y Parametros
        }
    }

    public function create(){
        return view('acceso.usuarios.create');  //Vista
    }

    public function store(UsuarioFormRequest $request){
        $usuario = new User;
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->save();

        return Redirect::to('acceso/usuarios');
    }

    public function edit($id){
        return view('acceso.usuarios.edit', ["usuario" => User::findOrFail($id)]);  //Vista y parametro
    }

    public function update(UsuarioFormRequest $request, $id){
        $usuario = User::findOrFail($id);
        $usuario->name = $request->get('name');
        $usuario->email = $request->get('email');
        $usuario->password = bcrypt($request->get('password'));
        $usuario->update();

        return Redirect::to('acceso/usuarios');
    }

    public function destroy($id){
        $usuario = DB::table('users')->where('id', '=', $id)->delete();
        return Redirect::to('acceso/usuarios');
    }

}
