<?php

namespace sysVentas\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;    //Sirve para hacer redirecciones
use Illuminate\Support\Facades\Input;   
use sysVentas\Http\Requests\VentaFormRequest;   //Validacion del formulario
use sysVentas\Venta;
use sysVentas\DetalleVenta;
use DB; //Clase de laravel
use Carbon\Carbon;  //Fecha y hora Zona horaria
use Response;
use Illuminate\Support\Collection;

class VentaController extends Controller
{
    public function __construct(){

    }

    public function index(Request $request){    //Muestra pagina inicial
        if($request){
            $query = trim($request->get('searchText')); // Trim : Elimina espacio en blanco del inicio y el final de la cadena
            $ventas = DB::table('ventas as v')->join('personas as p' , 'v.idcliente', '=' , 'p.idpersona')
                                                  ->join('detalles-venta as dv' , 'v.idventa', '=' , 'dv.idventa')
                                                  ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
                                                  ->where('v.num_comprobante','LIKE','%'.$query.'%')
                                                  ->orderBy('v.idventa','desc')
                                                  ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado','v.total_venta')
                                                  ->paginate(7);
            return view('ventas.ventas.index',["ventas" => $ventas, "searchText" => $query ]);  //Vista y Parametros
        }
    }

    public function create(){
        $personas = DB::table('personas')->where('tipo_persona','=','Cliente')->get();
        $articulos = DB::table('articulos as art')->join('detalles-ingreso as di' , 'art.idarticulo', '=' , 'di.idarticulo')
                                                  ->select(DB::raw('CONCAT(art.codigo," ",art.nombre) as articulo'), 'art.idarticulo', 'art.stock', DB::raw('(select precio_venta from `detalles-ingreso` where `art`.`idarticulo` = `detalles-ingreso`.`idarticulo` ORDER BY `detalles-ingreso`.`iddetalle_ingreso` DESC LIMIT 1) as precio_promedio'))
                                                  ->where('art.estado','=','Activo')
                                                  ->where('art.stock','>','0')
                                                  ->groupBy('articulo', 'art.idarticulo', 'art.stock', 'precio_promedio')
                                                  ->get();
        return view('ventas.ventas.create',["personas" => $personas, "articulos" => $articulos ]);  //Vista y Parametros
    }

    public function store(VentaFormRequest $request){
        try{
            DB::beginTransaction();

            $venta = new Venta;
            $venta->idcliente = $request->get('idcliente');
            $venta->tipo_comprobante = $request->get('tipo_comprobante');
            $venta->serie_comprobante = $request->get('serie_comprobante');
            $venta->num_comprobante = $request->get('num_comprobante');
            $venta->total_venta = $request->get('total_venta');

            $mytime = Carbon::now('America/Mexico_City');   //Obtiene la hora actual

            $venta->fecha_hora = $mytime->toDateTimeString();
            $venta->impuesto = '18';
            $venta->estado = 'A';
            $venta->save();

            $idarticulo = $request->get('idarticulo');
            $cantidad = $request->get('cantidad');
            $descuento = $request->get('descuento');
            $precio_venta = $request->get('precio_venta');

            $cont = 0;

            while($cont < count($idarticulo)){
                $detalle = new DetalleVenta;
                $detalle->idventa = $venta->idventa;
                $detalle->idarticulo = $idarticulo[$cont];
                $detalle->cantidad = $cantidad[$cont];
                $detalle->descuento = $descuento[$cont];
                $detalle->precio_venta = $precio_venta[$cont];
                $detalle->save();

                $cont++;
            }

            DB::commit();
        }catch(\Exception $e){ //Si hay un error se anula la transaccion
            DB::rollback();
        }

        return Redirect::to('ventas/ventas');
    }

    public function show($id){

        $venta = DB::table('ventas as v')->join('personas as p' , 'v.idcliente', '=' , 'p.idpersona')
                                             ->join('detalles-venta as dv' , 'v.idventa', '=' , 'dv.idventa')
                                             ->select('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado', 'v.total_venta')
                                             ->where('v.idventa','=', $id)
                                             ->groupBy('v.idventa','v.fecha_hora','p.nombre','v.tipo_comprobante','v.serie_comprobante','v.num_comprobante','v.impuesto','v.estado', 'v.total_venta')
                                             ->first();

        $detalles = DB::table('detalles-venta as d')->join('articulos as a', 'd.idarticulo','=','a.idarticulo')
                                                     ->select('a.nombre as articulo','d.cantidad','d.descuento','d.precio_venta')
                                                     ->where('d.idventa','=',$id)
                                                     ->get();
        
        return view('ventas.ventas.show',["venta" => $venta, "detalles" => $detalles ]);  //Vista y Parametros
    }

    public function destroy($id){
        $venta = Venta::findOrFail($id);
        $venta->Estado = 'C';
        $venta->update();
        return Redirect::to('ventas/ventas');
    }
}
