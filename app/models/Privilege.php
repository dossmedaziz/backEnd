<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{
    protected $table ="privileges";
    protected $fillable = [
    'privilege_name'
    ] ;
}
