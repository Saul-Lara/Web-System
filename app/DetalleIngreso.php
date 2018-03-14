<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    Protected $table = 'detalles-ingreso';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'iddetalle_ingreso'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'idingreso',
        'idarticulo',
        'cantidad',
        'precio_compra',
        'precio_venta'
    ];
}
