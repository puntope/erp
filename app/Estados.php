<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Estados extends Model
{

    protected $table = 'estados';

    protected $fillable = ['nombre','color'];

    protected $dateFormat = 'Y-m-d H:i:s';
    
}
