<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Details extends Model
{
    protected $table='details';
    protected $primaryKey='d_id';
    public $timestamps = false;
}
