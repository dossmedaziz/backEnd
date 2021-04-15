<?php

namespace App\Http\Controllers;

use App\models\User;
use App\models\Role;
use App\models\Action;
use App\models\Space;
use App\models\Client;
use App\models\Project;
use App\models\Contact;
use App\models\Privilege;
use App\models\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Support\Facades\Crypt ;
use Illuminate\Support\Facades\Mail;
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
                    // sending verification email
                    
                    $cryptedId = Crypt::encryptString($user->id) ;
                    $to_name  = $user->name;
                    $to_email = $user->email;
                    $data = array('name'=> $user->name ,'link' => "http://localhost:4200/updatePassword/".$cryptedId);
                    Mail::send('verificationEmail', $data, function($message) use ($to_name, $to_email) {
                    $message->to($to_email, $to_name)->subject('Reset Password');
                    $message->from('dossaziz18@gmail.com','Nachd-it');
                    });
                    
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
                        $isVerified = $user->verified ;
                        if(!$isVerified)
                        {
                            return response(['message'=>'invalid login credentials'],403);

                        }
                        return response()->json(['user'=>Auth::user(), 'token' => $accessToken ,'privileges'=>$privileges]) ;

            }






            public function search(Request $request)
            {
                    $searchKey = $request->searchKey ;
                   
                    $clients = Client::where('client_name','like',"%".$searchKey."%")->get();
                    $projects = Project::where('project_name','like','%'.$searchKey.'%')->with('client')->get();
                    $contacts = Contact::where('contact_name','like','%'.$searchKey.'%')->get();
                    return response()->json(["clients"=>$clients,"projects"=>$projects,"contacts"=>$contacts]);
            }



        public function changePassword(Request $request)
        {
            
            $token =  $request->token ; 
            $user_id = Crypt::decryptString($token) ;
            $user = User::find($user_id) ; 
            $user->update([
                'password'=>Hash::make($request->password),
            ]);
            
            $user->save() ; 
            $user->verified = 1  ;
            $user->save();
            return response()->json(["msg"=>"updated"]) ;


        }




        public function sendMail(Request $request)
        {

            $email = $request->email ;
            $user =  User::where('email',$email)->first() ; 
            if(is_null($user)){
                return  response()->json(["msg"=>"User not found"],403);
            }
            $cryptedId = Crypt::encryptString($user->id) ;
          
            $to_name  = $user->name;
            $to_email = $user->email;
            $data = array('name'=> $user->name ,'link' => "http://localhost:4200/resetPassword/".$cryptedId);
            Mail::send('emails', $data, function($message) use ($to_name, $to_email) {
            $message->to($to_email, $to_name)->subject('Reset Password');
            $message->from('dossaziz18@gmail.com','Nachd-it');
            });
            return response()->json(["msg"=>"Mail sent"]);
        }

        public function resetPassword(Request $request)
        {
        $token  = $request->token ;
         
        $user_id = Crypt::decryptString($token) ;
        
        $user = User::find($user_id) ;
        $user->update([
             "password"  => Hash::make($request->newPassword),
             ]);
        $user->save();
        return response()->json(["msg"=>"password changed"]);
        }
 }
