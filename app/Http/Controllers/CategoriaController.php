<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;
use sysVentas\Categoria;    //Se agrega el modelo a utilizar
use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use sysVentas\Http\Requests\CategoriaFormRequest;   //Validacion del formulario
use DB; //Clase de laravel

class CategoriaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $categorias = DB::table('categorias')->where('nombre','LIKE','%'.$query.'%')
                                                 ->where('condicion','=','1')
                                                 ->orderBy('idcategoria','desc')
                                                 ->paginate(7);
            return view('almacen.categoria.index',["categorias" => $categorias, "searchText" => $query ]);  //Vista y Parametros
        }
    }
    
    public function create(){
        return view('almacen.categoria.create');
    }

    public function store(CategoriaFormRequest $request ){    //Almacena los datos en la base de datos

        $categoria = new Categoria;
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->condicion = '1';
        $categoria->save();

        return Redirect::to('almacen/categoria');   //Redirecciona a la lista de categorias
    }

    public function show($id){  //Muestra informacion de un objeto

        return view("almacen.categoria.show", ["categoria" => Categoria::findOrFail($id)]);
    }

    public function edit($id){ //Se llama a formulario para modificar los datos

        return view("almacen.categoria.edit", ["categoria" => Categoria::findOrFail($id)]);
    }

    public function update(CategoriaFormRequest $request, $id){

        $categoria = Categoria::findOrFail($id);
        $categoria->nombre = $request->get('nombre');
        $categoria->descripcion = $request->get('descripcion');
        $categoria->update();

        return Redirect::to("almacen/categoria");
    }

    public function destroy($id){

        $categoria = Categoria::findOrFail($id);
        $categoria->condicion = '0';
        $categoria->update();

        return Redirect::to("almacen/categoria");
    }

}