<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract
{
    use Authenticatable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['sueldo','precio_hora','name', 'email', 'password', 'apellidos','fecha_nacimiento','alias','avatar','direccion','cp','ciudad','provincia','pais','telefono','movil','otros','nif','iban','rol_id','puesto_id','nivel_id','active'];
    protected $dates = ['fecha_nacimiento','last_login'];
    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Devuelve todas las tareas de este usuario
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function tareas() {
        return $this->hasMany('App\Tareas');
    }

    public  function rol() {
        return $this->hasOne('App\Roles');
    }

    public function hasRole($role) {
        return $this->rol_id <= $role;
    }

    public function isCreator($tarea) {

        if (isset($tarea)) {
            if ($this->id == Tareas::all()->find($tarea)->user_id) {
                return true;
            }
        }

        return false;
    }

    public function scopeProductivos($query) {
        return $query->where('nivel_id', '>', 0)->where('active',1);
    }



}
