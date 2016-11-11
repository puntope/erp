<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Puestos extends Model
{
    protected $table = 'puestos';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];
}
