<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Clientes extends Model
{
    protected $table = 'clientes';

    protected  $fillable = ['nombre','color','logo','tiempo_mes','visible','tipo_cliente_id','active'];
    protected $dateFormat = 'Y-m-d H:i:s';

    public function tareas()
    {
        return $this->hasMany('App\Tareas','cliente_id');
    }

    public function tipo()
    {
        return $this->hasOne('App\TiposClientes','id');
    }


    public function scopeVisibles($query) {
        return $query->where('visible',1);
    }

    public function scopeActivos($query) {
        return $query->where('active',1);
    }

    public function scopeTipoCliente($query,$tipo) {
        return $query->where('tipo_cliente_id',$tipo);
    }




}

