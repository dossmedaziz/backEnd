<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $table ='activity_logs';
    protected $fillable =[
        'user_id', 'action_id','service_id','space_id'
    ];



    public function logSaver($id,$action,$space,$serv_id)
    {


        $action = Action::where('action_name',$action)->first();
        $space  = Space::where('space_name',$space)->first();
        $action_id = $action->id;
        $space_id  = $space->id;

        $activity = ActivityLog::create([
            'user_id'=>  $id ,
            'action_id'=> $action_id,
            'space_id'=> $space_id,
            'service_id'=>  $serv_id
         ]);


    }
}
