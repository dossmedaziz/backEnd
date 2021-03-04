<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table ="privileges";
    protected $fillable = [
    'role_id','space_id','action_id'
    ] ;
}
