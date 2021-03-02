<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'project_name', 'description', 'status','start_date','client_id'
    ];
}
