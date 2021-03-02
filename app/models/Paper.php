<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Paper extends Model
{
    protected $fillable = [
        'paper_file', 'description', 'expiration_date','auto_email','project_id','paper_type'
    ];
}
