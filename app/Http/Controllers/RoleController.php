<?php

namespace App\Http\Controllers;

use App\models\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
   

    // create  role by admin
    public function create(Request $request)
    {
        $role = new Role($request->all());
        $role->save() ; 
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
           $role->update($request->all());
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
}
