<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //


            // create new user By admin
            public function create(Request $request)
            {
                $user=User::create([
                    'name'=> $request->input('name'),
                    'email'=> $request->input('email'),
                    'password'=> Hash::make($request->input('password')) , 
                    'phone_number' => $request->input('phone_number'),
                    // 'role_id' => '1',
                ]);
                return response()->json(['message'=>'created']) ;
            }




            // update user by user&admin 
            public function update(Request $request, $id)
            {
                $user = User::find($id) ;
                if(is_null($user))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $user->update($request->all());
                return response()->json('updated') ;
            }


    
            //get all users for admin
            public function getAllUsers()
            {
                $users = User::all() ;
                return $users ; 
            }


            // get user By id
            public function getUserById($id)
            {
                $user = User::find($id);
                if(is_null($user))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                return $user ;
            }


            // delete user by admin
            public function delete($id)
            {
                $user = User::find($id) ;
                if(is_null($user))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $user->delete() ;
                return response()->json(['message'=>'Deleted']) ;

            }
}
