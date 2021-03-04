<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Space extends Model
{
    protected $table = 'spaces';
    protected $fillable = [
        'space_name'
    ];
}
