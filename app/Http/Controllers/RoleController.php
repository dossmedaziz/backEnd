<?php

namespace App\Http\Controllers;

use App\models\Role;
use App\models\Privilege;
use App\models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class RoleController extends Controller
{


    // create  role by admin
    public function create(Request $request)
    {  

                $id = Auth::user()->id;
                $role = new Role();
                $role->role_name = $request->input('role_name') ;
                $role->save() ;
                 

                
                $table=$request->table;
                foreach ($table as $priv)
                {
                    $privilege = new Privilege();
                    $privilege->action_id = $priv['action_id'];

                    $privilege->space_id  =  $priv['space_id'];
                    $privilege->role_id   =   $role->id;
                    $privilege->save();

                }
                
                $activity = new ActivityLog();
                $activity->logSaver($id,'create','role',$role->id);

         return response()->json(['message'=>'created','role'=>$role]) ;



        }





       // update role by admin
       public function update(Request $request, $id)

       {

                    $role = Role::find($id) ;
                    if(is_null($role))
                    {
                        return response()->json(["message"=>"Not found"]);
                    }
                    $table=$request->table;
                    foreach ($table as $priv)
                    {
                        $privilege = new Privilege();
                        $privilege->action_id = $priv['action_id'];
    
                        $privilege->space_id  =  $priv['space_id'];
                        $privilege->role_id   =   $role->id;
                        $privilege->save();
    
                    }
    
                    $role->update($request->all());
                    
                    $activity = new ActivityLog();
                    $activity->logSaver($id,'update','role',$role->id);
                    return response()->json('updated') ;

       }




       // get all Roles by admin
       public function getAllRoles()
       {
           $roles = Role::all();
           return $roles ;
       }





       // get role by id
       public function getRoleById($id)
       {
             $role = Role::find($id) ;
             if(is_null($role))
             {
                 return response()->json(["message"=>"Not found"]);
             }
             return $role;

       }





       // delete role by admin
       public function delete($id)
       {

           $role = Role::find($id) ;
           if(is_null($role))
           {
               return response()->json(["message"=>"Not found"]);
           }
           $role->delete() ;
           return response()->json(['message'=>'Deleted']) ;


       }


       public function getRoleprivilegess($id)
       {
            $role = Role::where('id',$id)->with('privilige')->get();
            return $role;

       }
}
