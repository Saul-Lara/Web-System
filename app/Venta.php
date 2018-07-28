<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    Protected $table = 'ventas';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'idventa'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'idcliente',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'total_venta',
        'estado'
    ];
}
