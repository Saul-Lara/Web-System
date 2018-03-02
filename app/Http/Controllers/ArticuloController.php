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
        $categorias = DB::table('categorias')->where('condicion', '=', '1')->get();
        return view('almacen.articulo.create', ["categorias" => $categorias ]);
    }

    public function store(ArticuloFormRequest $request ){    //Almacena los datos en la base de datos

        $articulo = new Articulo;
        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = "Inactivo";

        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }
        $articulo->save();

        return Redirect::to('almacen/articulo');   //Redirecciona a la lista de categorias
    }

    public function show($id){  //Muestra informacion de un objeto

        return view("almacen.articulo.show", ["articulo" => Articulo::findOrFail($id)]);
    }

    public function edit($id){ //Se llama a formulario para modificar los datos
        $articulo = Articulo::findOrFail($id);
        $categorias = DB::table('categorias')->where('condicion', '=', '1')->get();
        return view("almacen.articulo.edit", ["articulo" => $articulo , "categorias" => $categorias]);
    }

    public function update(ArticuloFormRequest $request, $id){

        $articulo = Articulo::findOrFail($id);
        $articulo->idcategoria = $request->get('idcategoria');
        $articulo->codigo = $request->get('codigo');
        $articulo->nombre = $request->get('nombre');
        $articulo->stock = $request->get('stock');
        $articulo->descripcion = $request->get('descripcion');
        $articulo->estado = "Inactivo";

        if(Input::hasFile('imagen')){
            $file = Input::file('imagen');
            $file->move(public_path().'/imagenes/articulos/', $file->getClientOriginalName());
            $articulo->imagen = $file->getClientOriginalName();
        }

        $articulo->update();

        return Redirect::to("almacen/articulo");
    }

    public function destroy($id){

        $articulo = Articulo::findOrFail($id);
        $articulo->estado = "Inactivo";
        $articulo->update();

        return Redirect::to("almacen/articulo");
    }
}
