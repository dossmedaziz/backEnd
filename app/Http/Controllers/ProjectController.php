<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Support\Facades\Auth ;
use App\models\Project;
use App\models\ActivityLog;
use App\models\Action;
use App\models\Space;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

            // create new project By admin
            public function create(Request $request)
            {
                            $id = Auth::user()->id ;
                            $project = new Project($request->all());
                            $project->creator_id = $id;
                            $project->save();

                            $activity = ActivityLog::create([
                                'user_id'=> $id,
                                'action_id'=> 1,
                                'space_id'=> 2,
                                'service_id'=> $project->id
                             ]);

                            return response()->json(['message'=>'created','project'=>$project]) ;
                        }



            // update Project by user&admin
            public function update(Request $request, $id)
            {
                $user_id = Auth::user()->id;
                $project = Project::find($id) ;
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $project->update($request->all());

                $activity = ActivityLog::create([
                    'user_id'=> $id,
                    'action_id'=> 3,
                    'space_id'=> 2,
                    'service_id'=> $project->id
                 ]);

                return response()->json(['message'=>'updated','project'=>$project]) ;

            }


            // get user projects
            public function getUserProjects($id)
            {

                $project = Project::where('creator_id',$id)->get();


                if(is_null($project))
                {
                    return response()->json(["message"=> "not found"]);
                }

                return $project ;
            }

            //get all project for admin
            public function getAllProjects()
            {
                $projects = Project::all() ;
                return $projects ;
            }


            // get Project By id
            public function getProjectById($id)
            {
                $project = Project::find($id);
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                return $project ;
            }

            // delete project by admin
            public function delete($id)

            {
                $user_id = Auth::user()->id;

                $project = Project::find($id) ;
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }

                $project->delete() ;

                $activity = ActivityLog::create([
                    'user_id'=> $id,
                    'action_id'=> 4,
                    'space_id'=> 2,
                    'service_id'=> $project->id
                 ]);

                return response()->json(['message'=>'Deleted']) ;


            }
            //get papers project
            public function paperProject($id){
                $project = Project::Where('id',$id)->with('paper')->get();
                return $project;
            }
}
