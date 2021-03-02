<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'file', 'client_id', 'role_id'
    ];
}
