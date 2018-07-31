<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;
use sysVentas\Persona;      //Se agrega el modelo a utilizar
use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use sysVentas\Http\Requests\PersonaFormRequest;   //Validacion del formulario
use DB; //Clase de laravel

class ClienteController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $personas = DB::table('personas')->where('nombre','LIKE','%'.$query.'%')
                                             ->where('tipo_persona','=','Cliente')
                                             ->orwhere('num_documento','LIKE','%'.$query.'%')
                                             ->where('tipo_persona','=','Cliente')
                                             ->orderBy('idpersona','desc')
                                             ->paginate(7);
            return view('ventas.cliente.index',["personas" => $personas, "searchText" => $query ]);  //Vista y Parametros
        }
    }
    
    public function create(){
        return view('ventas.cliente.create');
    }

    public function store(PersonaFormRequest $request ){    //Almacena los datos en la base de datos

        $persona = new Persona;
        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');
        
        $persona->save();

        return Redirect::to('ventas/cliente');   //Redirecciona a la lista de categorias
    }

    public function show($id){  //Muestra informacion de un objeto

        return view("ventas.cliente.show", ["persona" => Persona::findOrFail($id)]);
    }

    public function edit($id){ //Se llama a formulario para modificar los datos

        return view("ventas.cliente.edit", ["persona" => Persona::findOrFail($id)]);
    }

    public function update(PersonaFormRequest $request, $id){

        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Cliente';
        $persona->nombre = $request->get('nombre');
        $persona->tipo_documento = $request->get('tipo_documento');
        $persona->num_documento = $request->get('num_documento');
        $persona->direccion = $request->get('direccion');
        $persona->telefono = $request->get('telefono');
        $persona->email = $request->get('email');

        $persona->update();

        return Redirect::to("ventas/cliente");
    }

    public function destroy($id){

        $persona = Persona::findOrFail($id);
        $persona->tipo_persona = 'Inactivo';
        $persona->update();

        return Redirect::to("ventas/cliente");
    }
}
