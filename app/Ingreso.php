<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    Protected $table = 'ingresos';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'idingreso'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'idproveedor',
        'tipo_comprobante',
        'serie_comprobante',
        'num_comprobante',
        'fecha_hora',
        'impuesto',
        'estado'
    ];
}
