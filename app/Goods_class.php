<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goods_class extends Model
{
    protected $table='goods_class';
    protected $primaryKey='goods_classid';
    public $timestamps = false;
}
