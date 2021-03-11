<?php

namespace App\Http\Controllers;

use App\models\Client;
use App\models\User;
use App\models\Action;
use App\models\Space;
use App\models\ActivityType;
use App\models\ActivityLog;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;
class ClientController extends Controller
{



    // create Client
    public function create(Request $request)
    {
        $id = Auth::user()->id;

        $client = new Client($request->all());
        $client->save();

        $action = Action::where('action_name','create')->first();
        $space  = Space::where('space_name','client')->first();
        $action_id = $action->id;
        $space_id  = $space->id;



                    $activity = new ActivityLog();
                    $activity->logSaver($id,$action_id,$space_id,$client->id);

                    return response()->json(['message'=>'created','client'=>$client]) ;

    }




    // update client
    public function update(Request $request, $id)
    {

        $user_id = Auth::user()->id;
        $client = Client::find($id) ;
        if(is_null($client))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $client->update($request->all());
        $client->save();

        $activity = ActivityLog::create([
            'user_id'=> $user_id,
            'activitytype_id'=> 2,
            'service_id'=> $client->id
         ]);
        return response()->json(['message'=>'updated','client'=>$client]) ;

    }


        // delete client by admin
        public function delete($id)
        {
          $user_id = Auth::user()->id;

            $id = Auth::user()->id;
            $client = Client::find($id) ;
            if(is_null($client))
            {
                return response()->json(["message"=>"Not found"]);
            }
            $activity = ActivityLog::create([
                'user_id'=> $user_id,
                'activitytype_id'=> 3,
                'service_id'=> $client->id
             ]);
            $client->delete() ;
            $activity = ActivityLog::create([
                'user_id'=> $id,
                'action_id'=> 4,
                'space_id'=> 1,
                'service_id'=> $client->id
             ]);
            return response()->json(['message'=>'Deleted']) ;


        }

   // get all Clients
   public function getAllclients()
   {
       $clients = Client::all() ;
       return $clients ;
   }

    // get user clients
   public function getUserClients($id)
   {

       $clients = Client::where('creator_id',$id)->get();


       if(is_null($clients))
       {
           return response()->json(["message"=> "not found"]);
       }

       return $clients ;
   }

   // get client by id
    public function getClientById($id)
    {
        $client = Client::find($id);
        if(is_null($client))
        {
            return response()->json(["message"=>"Not found"]);
        }
        return $client ;
    }



        // get project of the client
        public function projectClient($id){
            $client = Client::Where('id',$id)->with('project')->get();
            return $client;
        }

        //get contacts of the client
        public function getClientContact($id)
        {
            $client = Client::where('id',$id)->with('contact')->get();
            return $client;
        }

        // get bills of the client
    public function test($id)
    {
        $client = Client::where('id',$id)->with('bill')->get();
        return response($client);

    }

    public function test1($id)
    {
        $client = Client::where('id',$id)->with('contact')->get();
        return response($client);

    }
}
