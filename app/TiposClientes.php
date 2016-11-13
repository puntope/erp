<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposClientes extends Model
{
    protected $table = 'tipos_cliente';
    public $timestamps = false;

    protected  $fillable = ['nombre'];
}
