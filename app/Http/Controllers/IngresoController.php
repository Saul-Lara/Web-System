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
            $ingresos = DB::table('ingresos as i')->join('personas as p' , 'i.idproveedor', '=' , 'p.idpersona')
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

    public function store(IngresoFormRequest $request){
        try{
            DB::beginTransaction();

            $ingreso = new Ingreso;
            $ingreso->idproveedor = $request->get('idproveedor');
            $ingreso->tipo_comprobante = $request->get('tipo_comprobante');
            $ingreso->serie_comprobante = $request->get('serie_comprobante');
            $ingreso->num_comprobante = $request->get('num_comprobante');

            $mytime = Carbon::now('America/Mexico_City');   //Obtiene la hora actual

            $ingreso->fecha_hora = $mytime->toDateTimeString();
            $ingreso->impuesto = '18';
            $ingreso->estado = 'A';
            $ingreso->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $precio_compra = $request->get('precio_compra');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($idarticulo)){
                $detalle = new DetalleIngreso;
                $detalle->idingreso = $ingreso->idingreso;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->precio_compra = $precio_compra[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();

                $cont++;
            }

            DB::commit();
        }catch(\Exception $e){ //Si hay un error se anula la transaccion
            DB::rollback();
        }

        return Redirect::to('compras/ingreso');
    }

    public function show($id){

        $ingreso = DB::table('ingresos as i')->join('personas as p' , 'i.idproveedor', '=' , 'p.idpersona')
                                             ->join('detalles-ingreso as di' , 'i.idingreso', '=' , 'di.idingreso')
                                             ->select('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado',DB::raw('sum(di.cantidad*precio_compra) as total'))
                                             ->where('i.idingreso','=', $id)
                                             ->groupBy('i.idingreso','i.fecha_hora','p.nombre','i.tipo_comprobante','i.serie_comprobante','i.num_comprobante','i.impuesto','i.estado')
                                             ->first();

        $detalles = DB::table('detalles-ingreso as d')->join('articulos as a', 'd.idarticulo','=','a.idarticulo')
                                                     ->select('a.nombre as articulo','d.cantidad','d.precio_compra','d.precio_venta')
                                                     ->where('d.idingreso','=',$id)
                                                     ->get();
        
        return view('compras.ingreso.show',["ingreso" => $ingreso, "detalles" => $detalles ]);  //Vista y Parametros
    }

    public function destroy($id){
        $ingreso = Ingreso::findOrFail($id);
        $ingreso->Estado = 'C';
        $ingreso->update();
        return Redirect::to('compras/ingreso');
    }


}
