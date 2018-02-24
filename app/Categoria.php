<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    Protected $table = 'categorias';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'idcategoria'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'nombre',
        'descripcion',
        'condicion'
    ];
}
