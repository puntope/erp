<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comerciales extends Model
{

    protected $table = 'comerciales';

    protected $fillable = ['nombre','descripcion','horas','horas_mes','presupuesto','cliente_id','estado_id','tipo_proyecto_id'];

    protected $dateFormat = 'Y-m-d H:i:s';

    public function cliente()
    {
        return $this->belongsTo('App\Clientes');
    }

    public function tipoProyecto()
    {
        return $this->belongsTo('App\TiposProyecto');
    }

    public function estado()
    {
        return $this->belongsTo('App\Estados','estado_id');
    }



}
