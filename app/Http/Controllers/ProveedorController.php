<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;
use sysVentas\Persona;      //Se agrega el modelo a utilizar
use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use sysVentas\Http\Requests\PersonaFormRequest;   //Validacion del formulario
use DB; //Clase de laravel

class ProveedorController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $personas = DB::table('personas')->where('nombre','LIKE','%'.$query.'%')
                                             ->where('tipo_persona','=','Proveedor')
                                             ->orwhere('num_documento','LIKE','%'.$query.'%')
                                             ->where('tipo_persona','=','Proveedor')
                                             ->orderBy('idpersona','desc')
                                             ->paginate(7);
            return view('compras.proveedor.index',["personas" => $personas, "searchText" => $query ]);  //Vista y Parametros
        }
    }
    
    public function create(){
        return view('compras.proveedor.create');
    }

    public function store(PersonaFormRequest $request ){    //Almacena los datos en la base de datos

        $persona = new Persona;
        $persona->tipo_persona = 'Proveedor';
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        
        $persona->save();

        return Redirect::to('compras/proveedor');   //Redirecciona a la lista de categorias
    }

    public function show($id){  //Muestra informacion de un objeto

        return view("compras.proveedor.show", ["persona" => Persona::findOrFail($id)]);
    }

    public function edit($id){ //Se llama a formulario para modificar los datos

        return view("compras.proveedor.edit", ["persona" => Persona::findOrFail($id)]);
    }

    public function update(PersonaFormRequest $request, $id){

        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Proveedor';
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');

        $persona->update();

        return Redirect::to("compras/proveedor");
    }

    public function destroy($id){

        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Inactivo';
        $persona->update();

        return Redirect::to("compras/proveedor");
    }
}
