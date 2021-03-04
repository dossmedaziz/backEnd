<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    protected $table = 'actions';
    protected $fillable = [
        'action_name'
    ];
}
