<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goodsdo extends Model
{
    protected $table='goods';
    protected $primaryKey='goods_id';
    public $timestamps = false;
}
