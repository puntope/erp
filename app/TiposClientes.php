<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposClientes extends Model
{
    protected $table = 'tipos_cliente';

    protected  $fillable = ['nombre'];
}
