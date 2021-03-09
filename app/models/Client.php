<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients' ;
    protected $fillable = [
        'client_name','email','webSite','local','matFisc',
    ];



    public function project()
    {
        return $this->HasMany(Project::class) ;
    }
}
