<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\User;
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
                    // 'role_id' => '1',
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

            public function login(Request $request)
            {
                $login = $request->validate([
                    'email' => 'required|string',
                    'password' => 'required|string'
                ]) ;
            //  dd($login) ;
                        if(!Auth::attempt($login))
                        {
                            return response(['message'=>'invalid login credentials','access'=>'0']);
                        }
                        $accessToken = Auth::user()->createToken('authToken')->accessToken ;
                        return response(['user'=>Auth::user(), 'access_token' => $accessToken ,'access' =>'1']) ;
                    }
}
