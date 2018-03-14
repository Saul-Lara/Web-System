<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;
use sysVentas\Ingreso;      //Se agrega el modelo a utilizar
use sysVentas\DetalleIngreso;      //Se agrega el modelo a utilizar
use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use Illuminate\Support\Facades\Input;    //Sirve para
use sysVentas\Http\Requests\IngresoFormRequest;   //Validacion del formulario
use DB; //Clase de laravel
use Carbon\Carbon;  //Fecha y hora Zona horaria
use Response;
use Illuminate\Support\Collection;

class IngresoController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $ingresos = DB::table('ingresos as i')->join('personas as p' , 'i.proveedor', '=' , 'p.idpersona')
                                                  ->join('detalles-ingreso as di' , 'i.idingreso', '=' , 'di.idingreso')
                                                  ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
                                                  ->where('i.num_comprobante','LIKE','%'.$query.'%')
                                                  ->orderBy('i.idingreso','desc')
                                                  ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
                                                  ->paginate(7);
            return view('compras.ingreso.index',["ingresos" => $ingresos, "searchText" => $query ]);  //Vista y Parametros
        }
    }

    public function create(){
        $personas = DB::table('personas')->where('tipo_persona','=','Proveedor')->get();
        $articulos = DB::table('articulos as art')->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo')
                                                  ->where('art.estado','=','Activo')
                                                  ->get();
        return view('compras.ingreso.create',["personas" => $personas, "articulos" => $articulos ]);  //Vista y Parametros
    }


}
