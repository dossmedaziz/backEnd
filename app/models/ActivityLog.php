<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table ='activity_logs';
    protected $fillable =[
        'user_id', 'action_id','service_id','space_id'
    ];



    public function logSaver($id,$ac_id,$sp_id,$serv_id)
    {
        $activity = ActivityLog::create([
            'user_id'=>  $id ,
            'action_id'=> $ac_id,
            'space_id'=> $sp_id,
            'service_id'=>  $serv_id
         ]);


    }
}
