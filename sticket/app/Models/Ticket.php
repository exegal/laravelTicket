<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    //use HasFactory;
    protected $primarykey = 'idTicket';
    public $timestamps = false;


    ## Relacion a tabla clientes
    public function relCliente()
    {
        //metodo de relacion        //related          //foreignKey  //ownerKey
        return $this->belongsTo('\App\Models\Cliente', 'idCliente', 'idCliente');
    }


    ## Relacion a tabla Categorias
    public function relCategoria()
    {
        return $this->belongsTo(
                               '\App\Models\Categoria', //Related
                               'idCategoria', //foreignKey
                               'idCategoria'//ownerKey
                                );
    }
}
