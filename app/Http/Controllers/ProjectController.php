<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Support\Facades\Auth ;
use App\models\Project;
use App\models\ActivityLog;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

            // create new project By admin
            public function create(Request $request)
            {

                            // $project = Project::create([
                            //     'project_name'=> $request->input('project_name'),
                            //     'description'=> $request->input('description'),
                            //     'status'=> $request->input('status') ,
                            //     'start_date' => $request->input('start_date'),
                            //     'client_id' =>  $request->input('client_id')
                            // ]);;
                            $id = Auth::user()->id ;
                            $project = new Project($request->all());
                            $project->creator_id = $id;
                            $project->save();



                            $activity = ActivityLog::create([
                                'user_id'=> $id,
                                'activitytype_id'=> 1,
                                'service_id'=> $project->id
                             ]);
                             
                            return response()->json(['message'=>'created','project'=>$project]) ;
                        }



            // update Project by user&admin
            public function update(Request $request, $id)
            {

                $project = Project::find($id) ;
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $project->update($request->all());
                return response()->json('updated') ;
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

                $project = Project::find($id) ;
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $project->delete() ;
                return response()->json(['message'=>'Deleted']) ;


            }
}
