<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table ='roles' ;
    protected $fillable =[
        'role_name'
    ];



    
    public function priviliges()
    {
        return $this->HasMany('App\models\Privilege') ;
    }
}
