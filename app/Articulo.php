<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class Articulo extends Model
{
    Protected $table = 'articulos';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'idarticulo'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'idcategoria',
        'codigo',
        'nombre',
        'stock',
        'descripcion',
        'imagen',
        'estado'
    ];
}
