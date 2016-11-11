<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollos extends Model
{

    protected $table = 'desarrollos';

    protected $fillable = ['nombre','descripcion','horas','cliente_id','tipo_proyecto_id','finalizado','entrega'];

    protected $dateFormat = 'Y-m-d H:i:s';
    /**
     * Devuelve el cliente al que pertenece esta tarea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Clientes');
    }

    public function tipoProyecto()
    {
        return $this->belongsTo('App\TiposProyecto');
    }

    public function scopeFinalizados($query) {
        return $query->where('finalizado',1);
    }
    public function scopeEncurso($query) {
        return $query->where('finalizado',0);
    }

}
