<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table ='activity_logs';
    protected $fillable =[
        'user_id', 'action_id','service_id','space_id'
    ];
}
