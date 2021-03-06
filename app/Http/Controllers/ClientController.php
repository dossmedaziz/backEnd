<?php

namespace App\Http\Controllers;

use App\models\Client;
use App\models\User;
use Illuminate\Support\Facades\Auth ;
use Illuminate\Http\Request;
class ClientController extends Controller
{



    // create Client
    public function create(Request $request)
    {
        $role_id = Auth::user()->role_id ;
        if($role_id == 1)
                {
                    $client = Client::create([
                        'client_name'=> $request->input('client_name'),
                        'email'=> $request->input('email'),
                        'WebSite'=> $request->input('WebSite'),
                        'local' => $request->input('local'),
                        'matFisc' => $request->input('matFisc'),
                    ]);
                    return response()->json(['message'=>'created','client'=>$client]) ;
                }else{
                    return response()->json(["message"=>"unauthorized"]);
                }
    }




    // update client
    public function update(Request $request, $id)
    {
        if(Auth::user()->role_id == 1)
        {
        $client = Client::find($id) ;
        if(is_null($client))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $client->update($request->all());
        return response()->json('updated') ;
    }else{
        return response()->json(["message"=>"unauthorized"]);
    }
    }


        // delete client by admin
        public function delete($id)
        {

            if(Auth::user()->role_id == 1){
            $client = Client::find($id) ;
            if(is_null($client))
            {
                return response()->json(["message"=>"Not found"]);
            }
            $client->delete() ;
            return response()->json(['message'=>'Deleted']) ;
            }else{
                return response()->json(["message"=>"unauthorized"]);
            }

        }

   // get all Clients
   public function getAllclients()
   {
       $clients = Client::all() ;
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




}
