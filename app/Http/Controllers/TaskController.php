<?php

namespace App\Http\Controllers;

use App\models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
   



    public function getTaskByproject($id)
    {
      
        $tasks = Task::where([['parent_id',NULL],['project_id',$id]])->with('subtasks')->get() ;
        return $tasks ; 
    }
}
