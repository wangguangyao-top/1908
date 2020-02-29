<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_user extends Model
{
    protected $table = "user";
    protected $primaryKey = "user_id"; 
    public $timestamps = false;
}
