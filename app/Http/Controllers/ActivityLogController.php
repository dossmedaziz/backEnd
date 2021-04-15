<?php

namespace App\Http\Controllers;

use App\models\ActivityLog;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{

    //get all activities
    public function getAllactivities(){
        $activities = ActivityLog::all();
        return response($activities);
    }
        //get all activities
        public function getUserActivities($user_id){
            $activities = ActivityLog::where('user_id',$user_id)->get();
            return $activities ;
        }
}
