<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TiposProyecto extends Model
{
    protected $table = 'tipos_proyectos';

    protected  $fillable = ['nombre','logo'];
    
}
