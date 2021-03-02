<?php

namespace App\Http\Controllers;

use App\models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{

            // create new Contact By admin
            public function create(Request $request)
            {
                $contact=Contact::create([
                    'contact_name'=> $request->input('contact_name'),
                    'email'=> $request->input('email'),
                    'description'=> $request->input('description') ,
                    // 'client_id' => $request->input('phone_number'),
                    'phone' => $request->input('phone'),
                ]);
                return response()->json(['message'=>'created']) ;
            }




            // update Contact by user&admin
            public function update(Request $request, $id)
            {
                $contact = Contact::find($id) ;
                if(is_null($contact))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $contact->update($request->all());
                return response()->json('updated') ;
            }



            //get all Contact for admin
            public function getAllContact()
            {
                $contacts = Contact::all() ;
                return $contacts ;
            }


            // get Contact By id
            public function getContactById($id)
            {
                $contact = Contact::find($id);
                if(is_null($contact))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                return $contact ;
            }


            // delete Contact by admin
            public function delete($id)
            {
                $contact = Contact::find($id) ;
                if(is_null($contact))
                {
                    return response()->json(["message"=>"Not found"]);
                }
                $contact->delete() ;
                return response()->json(['message'=>'Deleted']) ;

            }
}