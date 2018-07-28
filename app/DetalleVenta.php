<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    Protected $table = 'detalles-venta';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'iddetalle_venta'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'idventa',
        'idarticulo',
        'cantidad',
        'precio_venta',
        'descuento'
    ];
}
