<?php

namespace sysVentas;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    Protected $table = 'personas';  //Nombre de la tabla que se va a utilizar

    Protected $primaryKey = 'idpersona'; //Nombre de la llave primaria

    Protected $fillable = [     //Especifica qué atributos pueden asignarse y pueden mostrarse
        'tipo_persona',
        'nombre',
        'tipo_documento',
        'num_documento',
        'direccion',
        'telefono',
        'email'
    ];
}
