<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'contact_name', 'email', 'description','phone','client_id'
        , 'position'
    ];
}
