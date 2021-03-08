<?php

namespace App\Http\Controllers;

use App\models\User;
use App\models\Role;
use App\models\Action;
use App\models\Space;
use App\models\Privilege;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Validator ;
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
                        'role_id' => $request->input('role_id'),
                    ]);
                    return response()->json(['message'=>'created','user'=>$user]) ;


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
                $role_id=$user->role_id ;
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



            //login
            public function login(Request $request)
            {
                $login = $request->validate([
                    'email' => 'required|string',
                    'password' => 'required|string'
                ]) ;



                        if(!Auth::attempt($login))
                        {
                            return response(['message'=>'invalid login credentials','access'=>'0']);
                        }


                        $accessToken = Auth::user()->createToken('authToken')->accessToken ;
                        return response(['user'=>Auth::user(), 'access_token' => $accessToken ,'access' =>'1']) ;

            }




            // sending privileges of user
            public function test()
            {
                $user = Auth::user();
                $role_id = $user->role_id;
                $privilege = Privilege::WHERE('role_id',$role_id)->with('space')->with('action')->get() ;


                return response()->json($privilege);
            }

 }
