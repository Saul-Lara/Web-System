<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use Illuminate\Support\Facades\Input;    //Sirve para subir datos a la base de datos (imagen)
use sysVentas\Http\Requests\ArticuloFormRequest;   //Validacion del formulario
use sysVentas\Articulo;    //Se agrega el modelo a utilizar
use DB; //Clase de laravel

class ArticuloController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $articulos = DB::table('articulos as a')->join('categorias as c', 'a.idcategoria', '=', 'c.idcategoria')
                                                    ->select('a.idarticulo', 'a.nombre', 'a.codigo', 'a.stock', 'c.nombre as categoria', 'a.descripcion', 'a.imagen', 'a.estado')
                                                    ->where('a.nombre','LIKE','%'.$query.'%')
                                                    ->orwhere('a.codigo','LIKE','%'.$query.'%')
                                                    ->orderBy('a.idarticulo','desc')
                                                    ->paginate(7);
            return view('almacen.articulo.index',["articulos" => $articulos, "searchText" => $query ]);  //Vista y Parametros
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
