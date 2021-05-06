<?php

namespace App\Http\Controllers;

use App\models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   


    public function addTask(Request $request)
    {
        // return $request ; 
        $task = new Task($request->task);
        $task->project_id = $request->project_id ;
        $task->save();
        return response()->json(["msg"=>"added!"]);
    }

    public function getTaskByproject($id)
    {
      
        $tasks = Task::where([['parent_id',NULL],['project_id',$id]])->with('subtasks')->get() ;
        return $tasks ; 
    }


}
