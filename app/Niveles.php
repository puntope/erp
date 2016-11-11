<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Niveles extends Model
{
    protected $table = 'niveles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['nombre'];
}
