<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    //nombre de la tabla LA PARTE CARDINAL DE UNO A MUCHOS ...Y OTRAS VA EN LOS MODELS
    /*protected $table = 'regiones' (Sirve para cuando el sistema de plurales no se adecua al
    nombre del Model)*/

    //primary Key Configuramos el model para que indique a Laravel cual es la primaryKey en la DB

    protected $primaryKey = 'idCategoria';

    //created_at y update_at son atribtutos que si o si tienen que estar en las tablas de la base de datos

    public $timestamps = false; // no tengos campost


}
