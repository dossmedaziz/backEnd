<?php

namespace App\Http\Controllers;

use App\models\User;
use App\models\Role;
use App\models\Action;
use App\models\Space;
use App\models\Privilege;
use App\models\ActivityLog;
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

                $user_id = Auth::user()->id;
                $userr = $request->user;
                $email = $userr['email'];
                $isFound = User::where('email',$email)->first();
               if($isFound)
               {
                    return response()->json(["message" => "Email already Used"],409) ;
               }
               
               
                    $password = "nachd-it";
                    $user=User::create([
                        'name'=> $userr['name'],
                        'email'=> $userr['email'],
                        'password'=> Hash::make($password) ,
                        'role_id' => $userr['role_id'],
                    ]);

                    $user->save();

                    
                    $activity = new ActivityLog();
                    $activity->logSaver($user_id,'create','user',$user->id);
                return response()->json(['message'=>'created','user'=>$user]) ;


            }




            // update user by user&admin
            public function update(Request $request,$id)
            {
                $user_id = Auth::user()->id;
                $user = User::find($id) ;
                $userr = $request->user;
                $email = $userr['email'];
               


                $isFound = User::where('email',$email)->where('id','<>',$id)->first();
               if($isFound)
               {
                    return response()->json(["message" => "Email already Used"],409) ;
               }
               

                $user->update([
                        'name'=> $userr['name'],
                        'email'=> $userr['email'],
                        'role_id' => $userr['role_id'],
                ]);
                $user->save() ;

                $activity = new ActivityLog();
                $activity->logSaver($user_id,'update','user',$user->id);
                return response()->json('updated') ;
            }



            //get all users for admin
            public function getAllUsers()
            {
                // $users = User::all()->with('role')->get() ;
                $users = User::with('role')->get() ;
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
            public function delete(Request $request)
            {

                $user_id = Auth::user()->id;
                $table = $request->users_id;

                foreach ($table as $t)
                {
                    $id= ($t['user_id']);
                    $user = User::find($id);
                    $user->delete();
                    $activity = new ActivityLog();
                    $activity->logSaver($user_id,'delete','user',$user->id);
                }
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
                            return response(['message'=>'invalid login credentials'],403);
                        }

                        $user = Auth::user();
                        $role_id = $user->role_id;
                        $privileges = Privilege::WHERE('role_id',$role_id)->with('space')->with('action')->get() ;

                        $accessToken = Auth::user()->createToken('authToken')->accessToken ;
                        return response()->json(['user'=>Auth::user(), 'token' => $accessToken ,'privileges'=>$privileges]) ;

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
