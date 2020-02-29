<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userinfo2 extends Model
{
    protected $table = "user_info";
    protected $primaryKey = "user_id"; 
    public $timestamps = false;
}
