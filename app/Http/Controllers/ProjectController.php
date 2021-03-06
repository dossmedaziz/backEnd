<?php

namespace App\Http\Controllers;
use App\models\User;
use Illuminate\Support\Facades\Auth ;
use App\models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

            // create new project By admin
            public function create(Request $request)
            {
                $role_id = Auth::user()->role_id ;
                if($role_id == 1)
                        {
                            $project = Project::create([
                                'project_name'=> $request->input('project_name'),
                                'description'=> $request->input('description'),
                                'status'=> $request->input('status') ,
                                'start_date' => $request->input('start_date'),
                                // 'client_id' => '1',
                            ]);
                            return response()->json(['message'=>'created','project'=>$project]) ;
                        }else{
                            return response()->json(["message"=>"unauthorized"]);
                        }
            }


            // update Project by user&admin
            public function update(Request $request, $id)
            {
                $role_id = Auth::user()->role_id ;
                if($role_id == 1)
                {
                $project = Project::find($id) ;
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $project->update($request->all());
                return response()->json('updated') ;
            }else{
                    return response()->json(["message"=>"unauthorized"]);
                }
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
                $role_id = Auth::user()->role_id ;
                if($role_id == 1)
                {
                $project = Project::find($id) ;
                if(is_null($project))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $project->delete() ;
                return response()->json(['message'=>'Deleted']) ;
            }else{
                return response()->json(["message"=>"unauthorized"]);
            }

            }
}
