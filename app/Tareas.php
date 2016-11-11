<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Tareas extends Model
{
    protected $table = 'tareas';

    protected $fillable = ['titulo','descripcion','tiempo','cliente_id','tipo_proyecto_id','user_id','desarrollo_id'];

    protected $dateFormat = 'Y-m-d H:i:s';


    /**
     * Devuelve el cliente al que pertenece esta tarea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function cliente()
    {
        return $this->belongsTo('App\Clientes');
    }

    /**
     * Devuelve el usuario al que pertenece esta tarea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user() {
        return $this->belongsTo('App\User');
    }

    /**
     * Devuelve el tipo de tarea de esta tarea
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tipoTarea() {
        return $this->belongsTo('App\TiposProyecto','tipo_proyecto_id');
    }


    /**
     * Devuelve las tareas de hoy
     * @param $query
     * @return mixed
     */
    public function scopeToday($query) {


        return $query->where(function($qu) {
            $yesterday = Carbon::today()->format('Y-m-d H:i:s');
            $tomorrow = Carbon::tomorrow()->format('Y-m-d H:i:s');
            $qu->whereBetween('updated_at',array($yesterday,$tomorrow))
            ->orWhere('tiempo','0');
        });

        }

    public function scopeMonth($query) {


        return $query->where(function($qu) {
            $after = Carbon::today()->startOfMonth()->format('Y-m-d H:i:s');
            $before = Carbon::today()->endOfMonth()->format('Y-m-d H:i:s');
            $qu->whereBetween('updated_at',array($after,$before))
                ->orWhere('tiempo','0');
        })->whereNotIn('tipo_proyecto_id',[2,11,12]);

    }

    public function scopeDesarrollo($query, $id) {
        return $query->where('desarrollo_id',[$id]);
    }



    public function scopeHorasMesMantenimiento($query, $mes = null, $ano = null)  {

        if (is_null($ano)) {
            $ano = Carbon::today()->format('Y');
        }

        if (is_null($mes)) {
            $mes = Carbon::today()->format('m');
        }

        $after = Carbon::createFromDate($ano,$mes,01)->startOfMonth()->format('Y-m-d H:i:s');
        $before = Carbon::createFromDate($ano,$mes,01)->endOfMonth()->format('Y-m-d H:i:s');

        $query->whereBetween('updated_at',array($after,$before))->whereNotIn('tipo_proyecto_id',[2,11,12]);


    }

    public function scopeHorasDesarrollo($query,$id)  {
        return $query->where('desarrollo_id',$id);
    }

    /**
     * Devuelve las tareas de hoy y las pendientes
     * @param $query
     * @return mixed
     */

    public function scopeTodayOrUncompleted($query) {
        return $query->where(function($qu) {
            $yesterday = Carbon::today()->format('Y-m-d H:i:s');
            $tomorrow = Carbon::tomorrow()->format('Y-m-d H:i:s');
            $qu->whereBetween('updated_at',array($yesterday,$tomorrow))
                ->orWhere('tiempo','0');
        });
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeFromUser($query) {
        return $query->where('user_id',Auth::user()->id);
    }

    public function scopeFromUserId($query,$id) {
        return $query->where('user_id',$id);
    }

    public function scopeFiltro($query,$filtro) {

        if (!empty($filtro['empleados'])) {

            $filters = implode(',',$filtro['empleados']);
            $query->whereIn('user_id', $filtro['empleados']);
        }

        if (!empty($filtro['clientes'])) {

            $filters = implode(',',$filtro['clientes']);
            $query->whereIn('cliente_id', explode(',',$filters) );
        }

        if (!empty($filtro['tipotareas'])) {
            $filters = implode(',',$filtro['tipotareas']);
            $query->whereIn('tipo_proyecto_id', $filtro['tipotareas']);
        }

        if (!empty($filtro['desde'])) {
            $query->where('updated_at', '>=', $filtro['desde']);
        }

        if (!empty($filtro['hasta'])) {
            $query->where('updated_at', '<=', $filtro['hasta']);
        }


        return $query->orderBy('tipo_proyecto_id');

    }



}
