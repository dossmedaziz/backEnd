<?php

namespace App\Http\Controllers;

use App\models\Role;
use App\models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth ;

class RoleController extends Controller
{


    // create  role by admin
    public function create(Request $request)
    {

             $role_id = Auth::user()->role_id ;
             $i = 0 ;

            if($role_id == 1)
            {

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

         return response()->json(['message'=>'created','role'=>$role]) ;

            }else{
                return response()->json(["message"=>"unauthorized"]);
            }

        }





       // update role by admin
       public function update(Request $request, $id)
       {
        $role_id = Auth::user()->role_id ;
        if($role_id == 1)
        {
           $role = Role::find($id) ;
           if(is_null($role))
           {
               return response()->json(["message"=>"Not found"]);
           }
           $role->update($request->all());
           return response()->json('updated') ;
        }else{
            return response()->json(["message"=>"unauthorized"]);
        }
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
        $role_id = Auth::user()->role_id ;
        if($role_id == 1)
        {
           $role = Role::find($id) ;
           if(is_null($role))
           {
               return response()->json(["message"=>"Not found"]);
           }
           $role->delete() ;
           return response()->json(['message'=>'Deleted']) ;
        }else{
            return response()->json(["message"=>"unauthorized"]);
        }

       }
}
