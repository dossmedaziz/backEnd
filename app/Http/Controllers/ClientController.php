<?php

namespace App\Http\Controllers;

use App\models\Client;
use Illuminate\Http\Request;
class ClientController extends Controller
{



    // create Client
    public function create(Request $request)
    {
        $client = new Client($request->all());
        $client->save();
        return response()->json(['message'=>'created']) ;
    }




    // update client 
    public function update(Request $request, $id)
    {
        $client = Client::find($id) ;
        if(is_null($client))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $client->update($request->all());
        return response()->json('updated') ;
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

    public function delete($id)
    {
        $client = Client::find($id);
        if(is_null($client))
        {
            return response()->json(["message"=>"Not found"]);
        }
        $client->delete();
            return response()->json(["message"=>"Deleted!"]);
           
    }
}
